<?php
include('inc/config.php');
echo "<p><a href='index.php'>< Back to Index</a></p>";
echo "<h1>Gadget</h1>";
echo "<table border=1 width='50%' style='border-collapse: collapse'>";
echo "<tr>";
echo "<td><b>Id</b></td>";
echo "<td><b>Reg Id</b></td>";
echo "<td><b>Type</b></td>";
echo "</tr>";
$result = mysql_query("SELECT * FROM `gadget`") or trigger_error(mysql_error());
while($row = mysql_fetch_array($result)){
    foreach($row AS $key => $value) {
        $row[$key] = stripslashes($value);
    }
    echo "<tr>";
    echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['reg_id']) . "</td>";
    echo "<td valign='top'>" . nl2br( $row['type']) . "</td>";
    echo "<td><a href=gadget_delete.php?id={$row['id']}>Delete</a></td> ";
    echo "</tr>";
}
echo "</table>";
?>
