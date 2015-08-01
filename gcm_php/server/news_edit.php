<?php
include('inc/config.php');
if (isset($_GET['id']) ) {
    $id = (int) $_GET['id'];
    if (isset($_POST['submitted'])) {
        foreach($_POST AS $key => $value) {
            $_POST[$key] = mysql_real_escape_string($value);
        }
        $sql = "UPDATE `news` SET  `title` =  '{$_POST['title']}' ,  `content` =  '{$_POST['content']}'   WHERE `id` = '$id' ";
        mysql_query($sql) or die(mysql_error());
        echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />";
        echo "<a href='news_list.php'>Back To Listing</a>";
    }
    $row = mysql_fetch_array ( mysql_query("SELECT * FROM `news` WHERE `id` = '$id' "));
    ?>

    <form action='' method='POST'>
    <p><b>Title:</b><br /><input type='text' name='title' value='<?= stripslashes($row['title']) ?>' />
    <p><b>Content:</b><br /><textarea name='content'><?= stripslashes($row['content']) ?></textarea>
    <p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' />
    </form>
<?php
}
?>
