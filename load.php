<?php
include_once('classes/DB.php');
include_once('classes/login.php');


if (login::islogged()) {
    $userid = login::islogged();
} else {
    die("not logged in ");
}


if (isset($_GET['reciver'])) {
$reciver =$_GET['reciver'];
}

 $messages = DB::query('SELECT messages.*, users.username ,users.profileimg
      FROM messages, users 
      WHERE ( ( receiver= ? AND sender = ? ) OR ( receiver = ? AND sender = ? ))
      AND users.id = messages.sender
      ORDER BY id ASC ', array($reciver,$userid,$userid,$reciver));
foreach ($messages as $m) {
$date =date('d-M-Y h:i a', strtotime($m['send_at']));

if ($m['sender'] == $userid) {
echo '<div class="chats_r">
';
}else{
echo '<div class="chats">
  <img src="'.$m['profileimg'].'" class="img-circle" />

';
}
	?>
 <?=$m['body']?> 
<small style="float: right;
    margin-top: 30px;" >
   <?=$date  ?></small>
</div>





<?php
}
