<?php 
include('classes/DB.php');
include('classes/login.php');
$tokenisvalid;
if (login::islogged()){
    $tokenisvalid = 1;

	if (isset($_POST['changepassword'])) {
		$oldpassword = $_POST['oldpassword'];
		$newpasswordrepeat = $_POST['newpasswordrepeat'];
		$newpassword = $_POST['newpassword'];
		$userid = login::islogged();
		   if (password_verify($oldpassword, DB::query('SELECT password FROM users WHERE id= ?', array($userid))[0]['password'])) {
		   		if ($newpassword == $newpasswordrepeat) {
                DB::query('UPDATE users SET password=? WHERE id=?', array(password_hash($newpassword, PASSWORD_BCRYPT), $userid));
		   		echo "password changed !! ";
		   		}else{


		   			echo "
<div class='alert alert-success'>
password dont match
</div>
";		   		}

	}
else{
		   			echo "
<div class='alert alert-success'>
incorrect old password
</div>
";
	}

						}
}elseif(isset($_GET['token'])){
$token =$_GET['token'];
if (DB::query('SELECT user_id FROM password_tokens WHERE token= ?' , array(sha1($token)))) {
$user_id = DB::query('SELECT user_id FROM password_tokens WHERE token= ?' , array(sha1($token)))[0]['user_id'];
$tokenIsValid = true;

	if (isset($_POST['changepassword'])) {
		$newpasswordrepeat = $_POST['newpasswordrepeat'];
		$newpassword = $_POST['newpassword'];

		   		if ($newpassword === $newpasswordrepeat) {
                DB::query('UPDATE users SET password=? WHERE id=?', array(password_hash($newpassword, PASSWORD_BCRYPT), $user_id));
		   		echo "password changed !! ";
                DB::query('DELETE FROM password_tokens WHERE user_id = ? ' ,array( $user_id ));
		   		}else{

		   			echo "
<div class='alert alert-success'>
password dont match
</div>
";
		   		}

	}

						} else {
                                                die ("token is invalid");    
                                                }

}else{
die("you cant access this page");

}
        
 ?>
                <div class="form-group">

<h1>Change your Password</h1>
<form method="post" action="<?php if(isset($tokenisvalid)){ echo $_SERVER['PHP_SELF']; }else{echo 'change_pass.php?token='.$token.'';} ?> "  >
       <?php if(isset($tokenisvalid))  { echo '<input  class="form-control" type="password" name="oldpassword" value="" placeholder="Write Your  oldpassword ..."><p />'; }?>
        <input type="password" name="newpassword" class="form-control" required="required" value="" autocomplete="off" placeholder="New Password ..."><p />
        <input type="password" name="newpasswordrepeat" class="form-control" required="required" autocomplete="off" value="" placeholder="Repeat Password ..."><p />
        <input type="submit" name="changepassword"  class="btn btn-info"  value="Change Password">
</form>
</div>