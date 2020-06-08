<?php

if($_POST["what"] === "frontPageInit")
{
    require_once "db.info.php";
    require_once "fs_no_functions/fsGetData.no.php";
    $response = new stdClass();
    $response->success = false;

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

    $response->success = true;

}

header("Content-Type: application/json");
header("Cache-Control: no-cache");
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);