<?php
include('classes/post.php');
include('classes/image.php');
include('classes/Notify.php');
include('includes/navbar.php');
include('classes/comment.php');
include('includes/header.php');
include('classes/frindlist.php');



$username = "";

if (isset($_POST['comment'])) {
    comment::creatcomment($_POST['commentbody'], $_GET['postid2'], $userid);
}

if (isset($_GET['username'])) {

    if (DB::query('SELECT username FROM users WHERE username =? ', array($_GET['username']))) {
        $username = DB::query('SELECT username FROM users WHERE username =? ', array($_GET['username']))[0]['username'];
        $userimg = DB::query('SELECT profileimg FROM users WHERE username =? ', array($_GET['username']))[0]['profileimg'];
        $userid = DB::query('SELECT id FROM users WHERE username =? ', array($_GET['username']))[0]['id'];
        $followerid = login::islogged();
        if (DB::query('SELECT user_id FROM followers WHERE followe_id =? AND user_id = ? ', array($followerid, $userid))) {
            $isfollowing = 1;
        }
        /////////////////////////delete///////////////////////////////////////////
        if (isset($_POST['deletepost'])) {
            if (DB::query('SELECT id FROM posts WHERE id =? AND user_id =? ', array($_GET['postid'], $followerid))) {
                DB::query('DELETE FROM posts WHERE id =? AND user_id  = ?', array($_GET['postid'], $followerid));
                DB::query('DELETE FROM post_likes WHERE post_id =? ', array($_GET['postid']));
                DB::query('DELETE FROM comments WHERE post_id =? ', array($_GET['postid']));

            }
        }
        /////////////////////////follow//////////////////////////////////////////
        if (isset($_POST['follow'])) {

            if (!DB::query('SELECT followe_id FROM followers WHERE user_id =? AND followe_id = ? ', array($userid, $followerid))) {
                DB::query('INSERT INTO followers VALUES("",?,?)', array($userid, $followerid));
            } else {
                if (DB::query('SELECT followe_id FROM followers WHERE user_id =? ', array($userid))) {
                    $isfollowing = 1;
                }
            }
            $isfollowing = 1;
        }
        /////////////////////////unfollow//////////////////////////////////////////

        if (isset($_POST['unfollow'])) {

            if (DB::query('SELECT followe_id FROM followers WHERE user_id =? AND followe_id = ? ', array($userid, $followerid))) {
                DB::query('DELETE  FROM followers WHERE user_id = ? AND followe_id = ? ', array($userid, $followerid));
                unset($isfollowing);
            }
        }
        /////////////////////////post/////////////////////////////////////////////
        if (isset($_POST['post'])) {
            if ($_FILES['postimg']['size'] == 0) {

                post::creatpost($_POST['postbody'], login::islogged(), $userid);
            } else {
                $postid = post::creatimg($_POST['postbody'], login::islogged(), $userid);
                image::uplodeimage('postimg', 'UPDATE posts SET postimg =? WHERE id = ? ', array($postid));
            }
        }
        if (isset($_GET['postid']) && !isset($_POST['deletepost'])) {
            post::likepost($_GET['postid'], $followerid);
        }
    } else {
        echo "<br>
        <br>
        <br>
        <div style = ' margin: 0 auto;'  >
        <div class='alert alert-danger text-center'>
        <strong>Warning!</strong>
        <hr />
        <i class='fa fa-warning fa-4x'></i>
        <p>
        USER IS NOT FOUND
        </p>

        </div>
        </div>



        ";
        die();
    }
} else {

    echo "<br>
    <br>
    <br>


    <div style = ' margin: 0 auto;'   >
    <div class='alert alert-danger text-center'>
    <strong>Warning!</strong>
    <hr />
    <i class='fa fa-warning fa-4x'></i>
    <p>
    There is no such a linke
    </p>

    </div>
    </div>



    ";
    die();
}
?>

<div>
    <div class="header-blue">

        <div class="container hero">
            <div class="row">
                <div class="imgcontainer1">
                    <img src="<?php echo $userimg; ?>" alt="Avatar" class="avatar1">
                    <form class="form-inline" action="profile.php?username=<?php echo $username; ?> " method="post">
                        <div style="text-align: center;" class="form-group">

                            <h1 style=" color: white; font-family: cursive; text-align: center;" >
                                <?php echo $username; ?> </h1>


                                <?php
                                if ($followerid != $userid) {

                                    if (isset($isfollowing)) {
                                        echo ' <input   class="btn btn-danger btn-lg" type="submit" name="unfollow" value="UnFlollow" class="fa fa-input"> <br> ';
                                        echo '
                                        <a href ="chat.php?reciver='.$userid.'" > <button style ="color: black;" class="btn btn-default btn-lg" type="button"><i class="fa fa-envelope"></i>Send Message</button></a>' ;
                                    } else {
                                        echo ' <input  class="btn btn-info btn-lg" type="submit" name="follow" value="Flollow" class="fa fa-input"> <br> ';
                                        echo '
                                        <a href ="chat.php?reciver='.$userid.'" > <button style ="color: black;" class="btn btn-default btn-lg" type="button"><i class="fa fa-envelope"></i>Send Message</button></a>' ;
                                    }
                                } else {
                                    echo '

                                    <div class="container">
                                    <a href="setting.php" data-toggle="tooltip" title="Edit Profile"><i style=" text-shadow: 2px 2px 4px #000000;
                                    color:white;" class="fa fa-cog fa-2x " ></i>
                                    </a>

                                    </div>
                                    ';
                                }
                                ?>

                            </div>                   
                        </div>
                    </div>
                </div>
            </div>

            <div style="width: 300px;     margin-top: 80px;   margin-right: 30px;  float: right; " class="panel panel-default friends">

              <h1 style="text-align: center;" class="page-header"><?php echo $username; ?> </h1>
              <div class="row">

                <div class="col-md-8">
                  <ul>
                    <li><strong>Name:</strong><?php echo $username; ?> </li>
                    <li><strong>Email:</strong>123@gmail.com</li>
                    <li><strong>City:</strong>Ismailia</li>
                    <li><strong>Gender:</strong>Male</li>
                    <li><strong>DOB:</strong>october 1944</li>
                </ul>
            </div>
        </div><br><br>

    </div>


    <div style="width: 300px;        position: absolute;         margin-top: 350px;   margin-left: 1020px;  float: right; " class="panel panel-default friends">
        <div class="panel-heading">
            <h3 class="panel-title" >Following <span class="badge"> <?php
            $f = frindlist::displaynum($userid);
            echo $f; ?> </span></h3>
        </div>
        <div class="panel-body">
            <ul>
                <?php
                $frindlis = frindlist::display($userid);
                echo $frindlis;
                ?> 
                <br>
            </ul>
            <a class="btn btn-primary" href="#">View All</a>
        </div>
    </div>  




</form>
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
            <form action="profile.php?username=<?php echo $username; ?> " method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea name="postbody" class="form-control" placeholder="Write on the wall"></textarea>
                </div>

                <input type="submit" class="btn btn-info <?php if ($userid !=  $followerid) {echo "disabled";} ?> " name="post" value="post"   <?php if ($userid !=  $followerid) {echo "disabled";} ?> >
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




<div class="post">
    <?php
    $posts = post::display($userid, $username, login::islogged(),  $profile = 1 , $topic = null );

    echo $posts;
    ?> </div>



    <?php include('includes/footer.php'); ?>