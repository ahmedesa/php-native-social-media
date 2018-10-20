<?php
include('classes/DB.php');
include('classes/login.php');
include('classes/post.php');
include('classes/comment.php');
include('classes/image.php');

if (login::islogged()) {
    $userid = login::islogged();
    $showtimeline = 1;
    $username = DB::query('SELECT * FROM users WHERE id =?',array($userid))[0]['username'];
} else {
    echo "not logged in ";
}
$profileimg = DB::query('SELECT * FROM users WHERE id =?',array($userid))[0]['profileimg'];
if (isset($_POST['uplodeprofileimg'])) {
   image::uplodeimage('profileimg','UPDATE users SET profileimg =? WHERE id = ? ',array( $userid));
}
?>
<img style="    border-radius: 5px;
    border: 1px solid #f5f5f6;" src="<?=$profileimg ?>">
<form style="display: inline-block;" action="profile.php?username=<?=$username?>" method="post" enctype="multipart/form-data"  >
  <h1>  Update The Profile Image </h1>
    <input class="btn btn-info" type="file" name="profileimg"  >
    <input class="btn btn-info" type="submit" name="uplodeprofileimg" value="Uplode Image" >


</form>