<?php
// on success: returns a single string
function fsGetTitle()
{
    require "db.info.php";
    $dbsqli = new mysqli($host, $user, $password, $dbname);
    $dbresult = $dbsqli->query("SELECT pageTitle FROM $tableNamePage WHERE rowID=1");
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