
<?php
include('classes/DB.php');
include('classes/login.php');

if (login::islogged()) {
    $userid = login::islogged();
} else {
    echo "not logged in ";
}

if(isset($_POST['user_comm']) && isset($_POST['user_name']))
{
  $comment=$_POST['user_comm'];
  $name=$_POST['user_name'];
  DB::query('INSERT INTO  messages VALUES ("",?,?,?,0 ,NOW()) ',array($comment , $userid , $name));

}

?>