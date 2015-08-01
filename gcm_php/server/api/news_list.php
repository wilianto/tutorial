<?php
include('../inc/config.php');
//set CORS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST");
}
$result = mysql_query("SELECT * FROM `news`") or trigger_error(mysql_error());
$data = [];
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) {
        $row[$key] = stripslashes($value);
    }
    array_push($data, $row);
}

echo json_encode($data);
?>
