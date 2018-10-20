<?php 
include('classes/DB.php');

if (isset($_POST['sendemail'])) {
		$email = $_POST['email'];
		$cstrong = True;
			$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                	$user_id = DB::query('SELECT id FROM users WHERE email= ?' , array($email))[0]['id'];
                	DB::query('INSERT INTO password_tokens VALUES ("" , ? , ?)' , array(sha1($token) , $user_id));
                	echo "email sended!!"."token is :".$token;
						}

 ?>
<h1>forgot the Password</h1>
<form action="forgot-pass.php" autocomplete="off" method="post">
        <input type="email" name="email" required="required" value="" autocomplete="off" placeholder="your email ..."><p />
        <input type="submit" name="sendemail" value="send email">
</form>