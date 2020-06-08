<?php
// Sicherheit -----------------------------------------------------------------
session_name("NFC");
session_start();
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    // session_gc();(PHP 7 >= 7.1.0)
    session_destroy();
    exit;
}
// ----------------------------------------------------------------------------
require_once "db.info.php";
$response = new stdClass();
$response->success = false;

if($_POST["what"] === "all")
{
    require_once "fs_no_functions/fsScaleImage.no.php";
    $response->imgLogoPresent = false; 
    $response->imgBoxPresent = false;
    $response->pdfBoxPresent = false;
    $request = json_decode($_POST["request"]); 
    $input = $request->stammData;

    // create vcf
    $data = $input;
    $txt = "BEGIN:VCARD\n";
    $txt .= "VERSION:2.1\n";
    $txt .= "N;CHARSET=UTF-8:". $data->name .";Vorname ;;;\n";
    $txt .= "FN;CHARSET=UTF-8:". $data->name ."\n";
    $txt .= "ORG;CHARSET=UTF-8:". $data->firma ."\n";
    // $txt .= "URL;type=WORK;CHARSET=UTF-8:https://". $data->url ."\n";
    $txt .= "URL;type=WORK;CHARSET=UTF-8:https://www.baeckerin.at\n";
    $txt .= "EMAIL;CHARSET=UTF-8;type=WORK;type=PREF:". $data->mail ."\n";
    $txt .= "TEL;type=CELL;type=VOICE:". $data->tel ."\n";
    $txt .= "ADR;CHARSET=UTF-8;type=WORK;type=pref:;;". $data->strasse .";". $data->ort .";;". $data->plz .";". $data->land ."\n";
    $txt .= "LABEL;WORK;PREF;ENCODING=QUOTED-PRINTABLE;CHARSET=UTF-8:". $data->strasse ."=0D=0A=\n";
    $txt .= $data->plz ." ". $data->ort ." ". $data->land ."\n";
    $txt .= "END:VCARD\n";
    $file = fopen("vcf/data.vcf", "w+");
    fwrite($file, $txt);
    fclose($file);

    // Kontaktdaten
    $dbsqli = new mysqli($host, $user, $password, $dbname);
    $dbsqli->set_charset("utf8");
    
    $dbstmt = $dbsqli->prepare("UPDATE $tableNamePage SET title=?, firma=?, name=?, strasse=?, plz=?, land=?, tel=?, mail=?, ort=? WHERE rowID=1");
    $dbstmt->bind_param("sssssssss", $input->title, $input->firma, $input->name, $input->strasse, $input->plz, $input->land, $input->tel, $input->mail, $input->ort);   
    $dbstmt->execute();
    $dbstmt->close();

    if($input->logo !== "")
    {
        $response->imgLogoPresent = true;
        $response->imgLogoSuccess = false;
        $imgSelector = $input->logo;

        if($_FILES[$imgSelector]["tmp_name"] !== "")
        {
            $mime = mime_content_type($_FILES[$imgSelector]["tmp_name"]);
            if($mime == "image/png" || $mime == "image/jpeg")
            {
                // save image file                       
                if(fsScaleImage($_FILES[$imgSelector]["tmp_name"], $mime))
                {

                    move_uploaded_file($_FILES[$imgSelector]["tmp_name"], "uploads/" . $_FILES[$imgSelector]["name"]);
                    $input->logo = "uploads/" . $_FILES[$imgSelector]["name"];

                    $dbstmt = $dbsqli->prepare("UPDATE $tableNamePage SET logo=? WHERE rowID=1");
                    $dbstmt->bind_param("s", $input->logo);   
                    $dbstmt->execute();
                    $dbstmt->close();

                    $response->logoSrc = $input->logo;
                    $response->imgLogoSuccess = true;
                }
                else
                {
                    // scale image failed
                    $input->logo = "false";
                    $response->imgLogoSuccess = false;
                }
            }
        }
    }

    // Boxen
    $dbsqli->query("DELETE FROM $tableNameBox");
    foreach($request->boxes as $key => $value)
    {
          
        $dbstmt = $dbsqli->prepare("INSERT INTO $tableNameBox (rowID, type, inputA, inputB) VALUES (?, ?, ?, ?)");

        if($value->type === "6")
        {
            $response->imgBoxPresent = true;
            $response->imgBoxSuccess = false;

            if($value->subType === "image")
            {
                $imgSelector = $value->inputB;

                if($_FILES[$imgSelector]["tmp_name"] !== "")
                {
                    $mime = mime_content_type($_FILES[$imgSelector]["tmp_name"]);
                    if($mime === "image/png" || $mime === "image/jpeg")
                    {
                        // save image file                       
                        if(fsScaleImage($_FILES[$imgSelector]["tmp_name"], $mime))
                        {
                            move_uploaded_file($_FILES[$imgSelector]["tmp_name"], "uploads/" . $_FILES[$imgSelector]["name"]);
                            $value->inputB = "uploads/" . $_FILES[$imgSelector]["name"];
                            $response->imgBoxSuccess = true;
                        }
                        else
                        {
                            // scale image failed
                            $value->inputB = "false";
                            $response->imgBoxSuccess = false;
                        }
                    }
                }
            }
        }
        elseif($value->type === "5")
        {
            $response->pdfBoxPresent = true;
            $response->pdfBoxSuccess = false;

            if($value->subType === "pdf")
            {
                $fileSelector = $value->inputB;

                if($_FILES[$fileSelector]["tmp_name"] !== "")
                {
                    $mime = mime_content_type($_FILES[$fileSelector]["tmp_name"]);
                    if($mime === "application/pdf")
                    {
                        // save pdf file                       
                        if(move_uploaded_file($_FILES[$fileSelector]["tmp_name"], "uploads/" . $_FILES[$fileSelector]["name"]))
                        {
                            $value->inputB = "uploads/" . $_FILES[$fileSelector]["name"];
                            $response->pdfBoxSuccess = true;
                        }
                        else
                        {
                            // save pdf failed
                            $response->pdfBoxSuccess = false;
                        }
                    }
                    else
                    {
                        // is not a pdf
                        $response->pdfBoxSuccess = false;
                    }
                }
            }
            elseif($value->subType === "pdf/fileExist")
            {
                $response->pdfBoxSuccess = true;
            }
        }

        $rowID = $key + 1;

        if($value->type === "5")
        {
            if($response->pdfBoxSuccess)
            {
                $dbstmt->bind_param("isss", $rowID, $value->type, $value->inputA, $value->inputB);   
                $dbstmt->execute();
                $dbstmt->close();
            }
        }
        else
        {
            $dbstmt->bind_param("isss", $rowID, $value->type, $value->inputA, $value->inputB);   
            $dbstmt->execute();
            $dbstmt->close();

        }

        $i++;
    }

    $dbsqli->close();
    $response->success = true;

}
elseif($_POST["what"] === "init")
{
    require_once "fs_no_functions/fsGetData.no.php";

    $result = fsGetData($tableNamePage);    
    $response->stammData = new stdClass();
    $response->stammData->title = $result["data"][0][1];
    $response->stammData->firma = $result["data"][0][2];
    $response->stammData->name = $result["data"][0][3];
    $response->stammData->strasse = $result["data"][0][4];
    $response->stammData->plz = $result["data"][0][5];
    $response->stammData->land = $result["data"][0][6];
    $response->stammData->tel = $result["data"][0][7];
    $response->stammData->mail = $result["data"][0][8];
    $response->stammData->logo = $result["data"][0][9];
    $response->stammData->ort = $result["data"][0][10];

    $result = fsGetData($tableNameBox);
    $response->numBoxes = $result["numRows"];
    if($result["numRows"])
    {
        foreach ($result["data"] as $key => $value) {

            $response->boxes[$key] = new stdClass();
            $response->boxes[$key]->type = $value[1];
            $response->boxes[$key]->inputA = $value[2];
            $response->boxes[$key]->inputB = $value[3];

        }
    }

    $result = fsGetData($tableNameUser);
    $response->stammData->userName = $result["data"][0][1];
    $response->stammData->userMail = $result["data"][0][3];
    
    $response->success = true;

}
elseif($_POST["what"] === "stammData")
{
    require_once "fs_no_functions/fsGetUser.no.php";
    $response->pwSuccess = false;
    $request = json_decode($_POST["request"]);
    
    if($request->oldPw !== "" && $request->userName !== "" && $request->userMail !== "")
    {
        $result = fsGetUser();
        if(password_verify($request->oldPw, $result['password']))
        {
            if($request->newPw === $request->newConfirmPw)
            {
                $request->newPw = password_hash($request->newPw, PASSWORD_DEFAULT);

                $dbsqli = new mysqli($host, $user, $password, $dbname);
                $dbsqli->set_charset("utf8");
                
                $dbstmt = $dbsqli->prepare("UPDATE $tableNameUser SET userpassword=?, username=?, usermail=? WHERE rowID=1");
                $dbstmt->bind_param("sss", $request->newPw, $request->userName, $request->userMail);   
                $dbstmt->execute();
                $dbstmt->close();
                
                $response->pwSuccess = true;
            }
        }
    }
    
    $response->success = true;
}



header("Content-Type: application/json");
header("Cache-Control: no-cache");
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

