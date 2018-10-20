<?php

include('classes/DB.php');
include('classes/login.php');

include('includes/header.php');
$message = '';

if (login::islogged()) {
    $userid = login::islogged();
 header('Location: index.php ');
} 
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
if (DB::query('SELECT email From users WHERE email=?', array($email))) {
                if (password_verify($password, DB::query('SELECT password FROM users WHERE email= ?', array($email))[0]['password'])) {
                	
                header('Location: index.php ');

		$cstrong = True;
			$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                	$user_id = DB::query('SELECT id FROM users WHERE email= ?' , array($email))[0]['id'];
                	DB::query('INSERT INTO login_tokens VALUES ("" , ? , ?)' , array(sha1($token) , $user_id));
                    setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
	}
	else {
                      $message =  " password is wrong ";

        }}else {

              $message =  "User not Registered "   ;           

    }


}
?>
<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">Login</div>
        <div class="panel-body">
            <form method="post" action="login.php ">
                <div class="imgcontainer">
                    <img src="layout/imges/img_avatar2.png" alt="Avatar" class="avatar">
                </div>
                <p />
                <span class="text-danger style='width:300px;  margin:50px; "><?php echo $message; ?></span>
                <p />

                <div class="form-group">
                    <label>User Email</label>
                    <input type="text" required="required" name="email" id="user_email" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" required="required" name="password" id="user_password" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
                    <a href="create-account.php"> Register for a new user</a>
                </div>
            </form>

        </div>
    </div>
</div>
  <?php  include('includes/footer.php'); ?>
