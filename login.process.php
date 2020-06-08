<?php

usleep(500);

$response = new stdClass();

if(!isset($_POST["username"]))
{
    $response->success = false;
    echo json_encode($response);
    exit;
}

if(!isset($_POST["password"]))
{
    $response->success = false;
    echo json_encode($response);
    exit;
}

require_once "fs_no_functions/fsGetUser.no.php";
$result = fsGetUser();

if(!$result["numRows"])
{
    $response->success = false;
    echo json_encode($response);
    exit;
}

// if(!password_verify($_POST["username"], $result['username']))
// {
//     $response->success = false;
//     echo json_encode($response);
//     exit;
// }

if($_POST["username"] !== $result['username'])
{
    $response->success = false;
    echo json_encode($response);
    exit;
}

if(!password_verify($_POST["password"], $result['password']))
{
    $response->success = false;
    echo json_encode($response);
    exit;
}

do 
{
    $bytes = openssl_random_pseudo_bytes(20, $cstrong);

} while (!$cstrong); 

$hex = bin2hex($bytes);

session_id($hex);
session_name("NFC");
session_start();

$_SESSION["username"] = $_POST['username'];

$response->success = true;
header("Content-Type: application/json");
header("Cache-Control: no-cache");
echo json_encode($response);