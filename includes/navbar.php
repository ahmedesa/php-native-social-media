<!-- Navbar -->
<?php include('includes/header.php'); 
include('classes/DB.php');
include('classes/login.php');
if (login::islogged()) {
    $userid = login::islogged();
} else {
 header('Location: login.php ');

}
$username = DB::query('SELECT * FROM users WHERE id = ?',array($userid))['0']['username'];

?>


<nav style=" border :none;  background: linear-gradient(135deg, #172a74, #21a9af); " class="navbar  navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">SOCIAL NETWORK </a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="profile.php?username=<?=$username  ?>">  <span class="glyphicon glyphicon-user"></span>  profile</a></li>
      <li><a href="my-messages.php">  <span class="glyphicon glyphicon-envelope"></span>  messages</a></li>

      <li class="dropdown notifications-menu ">
      <a   class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">
      <span class="glyphicon glyphicon-bell"></span>Notefication</a>
            <ul class="dropdown-menu" style="width: 200%;" >
       <p>Notefication  <a style="float: right;"  href="notification.php"> view all </a> </p>
       <hr>
<?php
if (DB::query('SELECT * FROM notification WHERE reciver =? ', array($userid))) {
    $notification = DB::query('SELECT * FROM notification WHERE reciver =? ORDER BY id DESC ', array($userid));
     /* if (strlen($message['body']) > 10) {
            $m = substr($message['body'], 0, 10) . ".......";
        } else {
            $m = $message['body'];
        } */
    $count  = 0 ;
    foreach ($notification as $n) {
           $count++ ;
        if ($n['type'] == 1) {
            $sendername = DB::query('SELECT username FROM users WHERE id = ? ', array($n['sender']))[0]['username'];
            if ($n['extra'] == "") {
                echo "
            <li class='header'>You have 0 notification</li>
            ";
            } else {
                $extra = json_decode($n['extra']);
                echo "
            <ul class='dropdown-menu'>
            <li class='header'><strong>".$sendername ." </strong> mention you in a post! -" . $extra->postbody."</li>
            </ul> 
            <hr>
"; 
           }
        } elseif ($n['type'] == 2) {
            $sendername = DB::query('SELECT username FROM users WHERE id = ? ', array($n['sender']))[0]['username'];
                     echo "
            <li class='header'><strong>".$sendername . "</strong> like your post!</li>
            <hr>
"; 
        }
if ($count == 3) {
          break;

}                }
}

?>
          </ul>

      </li>


          </ul>
    <form class="navbar-form navbar-left" action="search.php" method="POST" >
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="searchbox">
      </div>
      <input class="btn btn-default"  type="submit" name="search"   value="search" >

    </form>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
  </div>

</nav>
