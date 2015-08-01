<?php
use PHP_GCM\Sender;
use PHP_GCM\Message;

include('inc/config.php');

if (isset($_POST['submitted'])) {
    foreach($_POST AS $key => $value) {
        $_POST[$key] = mysql_real_escape_string($value);
    }
    $sql = "INSERT INTO `news` ( `title` ,  `content`  ) VALUES(  '{$_POST['title']}' ,  '{$_POST['content']}'  ) ";
    $query = mysql_query($sql) or die(mysql_error());
    $id = mysql_insert_id($conn);

    //push notification
    $sender = new Sender($gcm_api_key);
    $message = new Message();
    $message->data([
        'title' => 'New News From Server',
        'message' => $_POST['title'],
        'url' => "#/detail/{$id}",
    ]);
    
    $sql = "SELECT * FROM `gadget`";
    $query = mysql_query($sql) or trigger_error(mysql_error());
    while($row = mysql_fetch_array($query)){
        try {
            //push notification
            $result = $sender->send($message, $row['reg_id'], 1); //$numberOfRetryAttempts
        } catch (\InvalidArgumentException $e) {
            // $deviceRegistrationId was null
        } catch (PHP_GCM\InvalidRequestException $e) {
            // server returned HTTP code other than 200 or 503
        } catch (\Exception $e) {
            // message could not be sent
        }
    }

    echo "Added row.<br />";
    echo "<a href='news_list.php'>Back To Listing</a>";
}
?>

<form action='' method='POST'>
<p><b>Title:</b><br /><input type='text' name='title'/>
<p><b>Content:</b><br /><textarea name='content'></textarea>
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' />
</form>
