
<?php
include('includes/navbar.php');

include('includes/header.php');




if (isset($_POST['confirm'])) {

        if (isset($_POST['alldevices'])) {

                DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>login::islogged()));

        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
        }
	header('location: login.php');

}




?>

<form style="text-align: center;" action="logout.php" method="post">

<h1>Logout of your Account?</h1>
<p>Are you sure you'd like to logout?</p>
        <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
        <input class="btn btn-info" type="submit" name="confirm" value="Confirm">
</form>
  <?php  include('includes/footer.php'); ?>
