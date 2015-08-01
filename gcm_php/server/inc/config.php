<?php
require('../vendor/autoload.php');

$db_host = 'localhost';
$db_name = 'tutorial_gcm_php';
$db_user = 'root';
$db_pass = '';

$conn = mysql_connect($db_host, $db_user, $db_pass) or die('Failed to connect database');
mysql_select_db($db_name) or die('Failed to select DB');

$gcm_api_key = 'xxxxxxx';
