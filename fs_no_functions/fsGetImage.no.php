<?php
// on success: returns a single string
function fsGetImage()
{
    require "db.info.php";
    $dbsqli = new mysqli($host, $user, $password, $dbname);
    $dbresult = $dbsqli->query("SELECT userInputOne FROM $tableNameData WHERE typeID=5");
    if($dbresult->num_rows)
    {
        $rowresult = $dbresult->fetch_row();
        $result = $rowresult[0];
    }
    else
    {
        $result = $dbresult->num_rows;
    }
    $dbresult->free();
    $dbsqli->close();
    return $result;
}