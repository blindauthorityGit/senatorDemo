<?php
// on success:
// Array ( 
//     [data] => Array ( [0] => Array ( [0] => INT [1] => STRING [2] => STRING [3] => STRING [4] => TIMESTAMP )
//     [numRows] => INT
//   )
function fsGetData($tabelName)
{
    require "db.info.php";
    $dbsqli = new mysqli($host, $user, $password, $dbname);
    $dbsqli->set_charset("utf8");
    $dbresult = $dbsqli->query("SELECT * FROM $tabelName");
    if($dbresult->num_rows)
    {
        $result["data"] = $dbresult->fetch_all();
        $result["numRows"] = $dbresult->num_rows;
    }
    else
    {
        $result["numRows"] = $dbresult->num_rows;
    }
    $dbresult->free();
    $dbsqli->close();
    return $result;
}