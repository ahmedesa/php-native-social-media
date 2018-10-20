<?php
include('classes/DB.php');
include('includes/header.php');
$message = '';

if (isset($_POST['createaccount'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $passwordrepeat = $_POST['passwordrepeat'];
    $defaultimg ='layout/imges/user.png';

    if (!DB::query('SELECT username From users WHERE username=?', array($username))) {
             if ($password == $passwordrepeat) {
        if (strlen($username) >= 3 && strlen($username) <= 32) {

            if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                if (strlen($password) >= 6 && strlen($password) <= 60) {

                    DB::query('INSERT INTO users VALUES ("" , ?, ?, ? , ?)', array($username, password_hash($password, PASSWORD_BCRYPT), $email ,$defaultimg));
                header('Location: login.php ');

                }
                else {
                    $message =  'Invalid password!';
                }
            } else {
                $message =  'Invalid username0';
            }
        } else {
           $message =  'Invalid username1';
        }
    } else{
           $message =  'password dosnt match ';
                }
            } 
                else {
        $message = 'User already exists!';
    }
}
?>

<div class="container">

    <div class="panel panel-default">

        <div class="panel-heading">Register</div>
        <div class="panel-body">
            <form action="create-account.php" method="post">
            
                <p />
                <span class="text-danger style='width:300px;  margin:50px; "><?php echo $message; ?></span>
                <p />

                <div class="form-group">
                    <label>UserName</label>
                    <input value="<?php if (isset($_POST['username'])) { echo($_POST['username']);}   ?> " type="text" required="required" name="username" placeholder="Username ..." class="form-control" />
                </div>
                
                 <div class="form-group">
                    <label>Email</label>
                    <input value="<?php if (isset($_POST['email'])) { echo($_POST['email']);}   ?> "  type="text" required="required" name="email" placeholder="someone@somesite.com" class="form-control" />
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" required="required" name="password" placeholder="write your Password"  class="form-control" />
                </div>

                <div class="form-group">
                    <label>Repeat  Password</label>
                    <input type="password" required="required" name="passwordrepeat" placeholder=" Repeate Password"  class="form-control" />
                </div>

                <div class="form-group">
                    <input type="submit"  name="createaccount"  class="btn btn-info"  value="Create Account" />
                </div>
            </form>

        </div>
    </div>
</div>



  <?php  include('includes/footer.php'); ?>
