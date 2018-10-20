<?php
include('includes/navbar.php');
include('includes/header.php');
include('classes/post.php');
include('classes/image.php');
include('classes/comment.php');
if (login::islogged()) {
    $userid = login::islogged();
}
if (isset($_GET['topic'])) {
if (DB::query('SELECT topics FROM posts WHERE FIND_IN_SET(?,topics) ',array($_GET['topic']))) {
	?>
 <div class="post">
        <?php
     $posts = post::display($userid, $username, $loggeduserid = login::islogged() , $profile = null , $topic = $_GET['topic']);
        echo $posts; ?> </div>
          <?php  
        }
}

     include('includes/footer.php'); 