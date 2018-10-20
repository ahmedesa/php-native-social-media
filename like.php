<?php
include('classes/DB.php');
include('classes/login.php');

if (login::islogged()) {
    $userid = login::islogged();
    $showtimeline = 1;
} else {
    echo "not logged in ";
}

if (isset($_POST['like'])){   

           $id = $_POST['id'];
           DB::query('UPDATE posts SET likes = likes-1 WHERE id =? ', array($id));
           DB::query('DELETE FROM post_likes WHERE post_id = ? AND user_id = ? ', array($id, $userid));
    
  }elseif(isset($_POST['unlike'])){

            $id = $_POST['id'];
           DB::query('UPDATE posts SET likes = likes+1 WHERE id =? ', array($id));
          DB::query('INSERT INTO post_likes VALUES("",?,?)', array($id, $userid));
    }   
?>



