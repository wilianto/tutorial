<?php
include('inc/config.php');
$id = (int) $_GET['id'];
mysql_query("DELETE FROM `news` WHERE `id` = '$id' ") ;
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> ";
?>

<a href='news_list.php'>Back To Listing</a>
