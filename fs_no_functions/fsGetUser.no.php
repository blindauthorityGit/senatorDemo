<?php

function fsGetUser()
{
    require "db.info.php";
    $dbsqli = new mysqli($host, $user, $password, $dbname);
    $dbresult = $dbsqli->query("SELECT * FROM $tableNameUser WHERE rowID=1");
    if($dbresult->num_rows)
    {
        $rowresult = $dbresult->fetch_row();
        $result["username"] = $rowresult[1];
        $result["password"] = $rowresult[2];
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