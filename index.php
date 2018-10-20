<?php

include('classes/post.php');
include('classes/comment.php');
include('includes/navbar.php');
include('includes/header.php');
include('classes/frindlist.php');
include('classes/Notify.php');

if (login::islogged()) {
    $userid = login::islogged();
    $showtimeline = 1;
}

if (isset($_GET['postid'])) {
    post::likepost($_GET['postid'], $userid);
}
if (isset($_POST['comment'])) {
    comment::creatcomment($_POST['commentbody'], $_GET['postid2'], $userid);
}

if (isset($_POST['post'])) {
    if ($_FILES['postimg']['size'] == 0) {
        post::creatpost($_POST['postbody'], login::islogged(), $userid);
    } else {
        $postid = post::creatimg($_POST['postbody'], login::islogged(), $userid);
        image::uplodeimage('postimg', 'UPDATE posts SET postimg =? WHERE id = ? ', array($postid));
    }
}

?>

<br>
<br>
<br>
<br>
<div class="col-md-8">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Write Post</h3>
        </div>
        <div class="panel-body">
            <form action="index.php ?> " method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea name="postbody" class="form-control" placeholder="Write on the wall"></textarea>
                </div>

                <input type="submit" class="btn btn-info " name="post" value="post"  >
                <div class="pull-right">
                    <div class="btn-toolbar">
                        <div class="input-group">
                            <label class="btn btn-warning" >
                                <input name="postimg"  type="file" style="display:none;">
                                <i class="fa fa-file-image-o"></i> image
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>



<div style="width: 300px;      margin-top: 40px;  margin-right: 30px;  float: right; " class="panel panel-default friends">
  <div class="panel-heading">
      <h3 class="panel-title" >Following <span class="badge">
       <?php
       $f = frindlist::displaynum($userid);
       echo $f;
       ?> 
   </span></h3>
</div>
<div class="panel-body">
    <ul>
     <?php
     $frindlis = frindlist::display($userid);
     echo $frindlis;
     ?> 


     <br>

 </ul>
 <a class="btn btn-primary" href="#">View All </a>
</div>
</div>  

<div class="post">
    <?php
    $posts = post::display($userid, $username, login::islogged() ,  $profile = null , $topic = null );

    echo $posts; ?> </div>





    <?php  include('includes/footer.php'); ?>
