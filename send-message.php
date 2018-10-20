<?php
include('includes/navbar.php');
include('includes/header.php');


if (login::islogged()) {
    $userid = login::islogged();
    $showtimeline = 1;
} else {
    echo "not logged in ";
}
if (isset($_POST['sendmassege'])) {
	if (DB::query('SELECT * FROM users WHERE id =? ', array(htmlspecialchars($_GET['reciver'])) ) && $_GET['reciver'] !=$userid ) {
	
	
$massege = $_POST['body'];
DB::query('INSERT INTO  messages VALUES ("",?,?,?,0 ) ',array($massege , $userid , htmlspecialchars($_GET['reciver'])));
echo "
<div style ='text-align: center; ' class ='alert alert-info'> <span class='glyphicon glyphicon-ok'></span>
 Your Has Massege Been Send
</div>




";

}else{
echo " 
<div style ='text-align: center; ' class ='alert alert-danger'> <span class='glyphicon glyphicon-remove'></span>
 Cant Send This Message
</div>

";
}
}
?>

    <div class="container" >
        <div class="row pad-top pad-bottom">


                <div class="chat-box-div">
                    <div class="chat-box-head">
 Send Message                      
                    </div>
               


<form method="POST" action="send-message.php?reciver=<?php echo htmlspecialchars($_GET['reciver']); ?>" >
                    <div class="chat-box-footer">
                        <div class="input-group">
                            <input style="height: 70px;" name="body" type="text" class="form-control" placeholder="Enter Text Here...">
                            <span class="input-group-btn">
                            <input class="btn btn-info" type="submit" name="sendmassege" value="Send Message" >  
                            </span>
                        </div>
                    </div>


                    </form>


                </div>

         
                              

                </div>

            </div>















