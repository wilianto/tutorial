<?php
include('../inc/config.php');

//set CORS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST");
}

foreach($_POST AS $key => $value) {
    $_POST[$key] = mysql_real_escape_string($value);
}

$sql = "SELECT * FROM `gadget` WHERE `reg_id` = '{$_POST['reg_id']}'";
$query = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($query) == 0){
    $sql = "INSERT INTO `gadget` ( `reg_id` ,  `type`  ) VALUES(  '{$_POST['reg_id']}' ,  '{$_POST['type']}'  ) ";
    mysql_query($sql) or die(mysql_error());
    echo json_encode($_POST);
}
?>
