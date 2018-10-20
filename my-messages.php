<?php
include('includes/navbar.php');
include('includes/header.php');
if (login::islogged()) {
    $userid = login::islogged();
}
 $messages = DB::query('SELECT 
CONCAT(GREATEST(sender,receiver)," ",LEAST(sender,receiver)) AS x, 
MAX(send_at) AS date_message, 
messages.* 
FROM messages
WHERE sender= ? || receiver=?
GROUP BY x
ORDER BY date_message DESC;', array($userid,$userid  ));

 ?>

<div class="panel panel-default ">
              <div class="panel-heading">
              <h2 style="text-align: center;" >conversationes</h2>
              </div>

<div class="panel-body">
      

<?php

    foreach ($messages as $message) {
$last_message = DB::query('SELECT body FROM messages WHERE send_at = ?' ,array($message['date_message']))[0]['body'];
$date =date('d/m h:i a', strtotime($message['date_message']));
     if ($message['sender'] == $userid ) {
$user =  DB::query('SELECT * FROM users WHERE id = ?' ,array($message['receiver']))[0]['username'];
$img =DB::query('SELECT * FROM users WHERE id = ?' ,array($message['receiver']))[0]['profileimg'];
$id = $message['receiver'];
            }else{
$user =  DB::query('SELECT * FROM users WHERE id = ?' ,array($message['sender']))[0]['username'];
$img =DB::query('SELECT * FROM users WHERE id = ?' ,array($message['sender']))[0]['profileimg'];
$id = $message['sender'];
            }
        if (strlen($last_message) > 15) {
            $m = substr($last_message, 0, 15) . ".......";
        } else {
            $m = $last_message;
        }

?>
<a href="chat.php?reciver=<?=$id ?>">
  <div class="msg-body"> 
<strong class="msg-sender"> <?=$user?> </strong>
<img class="msg-sender-img" src="<?=$img ?>">
<span class="msg-topic"> <?=$m?> </span>
<span class="msg-date">  <?=$date?> </span>
        </div>
       </a>     

<?php

    }
?>


   </div>

</div>





<?php    include('includes/footer.php'); ?>