<?php  ///id: id,
       /// showlike: 1
include('classes/DB.php');
include('classes/login.php');

if (login::islogged()) {
    $userid = login::islogged();
    $showtimeline = 1;
} else {
    echo "not logged in ";
}
  if (isset($_POST['showlike'])) {
	$id =$_POST['id'] ;

$likes =DB::query('SELECT * FROM posts WHERE id = ? ',array($id))['0']['likes'];
echo $likes;
}





  ?>