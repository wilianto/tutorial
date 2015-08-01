<?php
include('inc/config.php');
echo "<p><a href='index.php'>< Back to Index</a></p>";
echo "<h1>News</h1>";
echo "<table border=1 width='50%' style='border-collapse: collapse'>";
echo "<tr>";
echo "<td><b>Id</b></td>";
echo "<td><b>Title</b></td>";
echo "<td><b>Content</b></td>";
echo "</tr>";
$result = mysql_query("SELECT * FROM `news`") or trigger_error(mysql_error());
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) {
        $row[$key] = stripslashes($value);
    }
    echo "<tr>";
    echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['title']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['content']) . "</td>";
    echo "<td valign='top'><a href=news_edit.php?id={$row['id']}>Edit</a></td><td><a href=news_delete.php?id={$row['id']}>Delete</a></td> ";
    echo "</tr>";
}
echo "</table>";
echo "<a href=news_new.php>New Row</a>";
?>
