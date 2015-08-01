<?php
include('../inc/config.php');
//set CORS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST");
}
if (isset($_GET['id']) ) {
    $id = (int) $_GET['id'];
    $row = mysql_fetch_array ( mysql_query("SELECT * FROM `news` WHERE `id` = '$id' "));
    echo json_encode($row);
}
?>
