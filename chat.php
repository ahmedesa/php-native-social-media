<?php
include('includes/navbar.php');
include('includes/header.php');


if (login::islogged()) {
    $userid = login::islogged();
}
?>

<?php if (isset($_GET['reciver']) && $_GET['reciver'] != $userid ) {
 $username = DB::query('SELECT username FROM users WHERE id = ?' , array($_GET['reciver']))[0]['username'] ; 

 ?>
  
    <div class="container">
        <div class="row pad-top pad-bottom">
            <div class="chat-box-div">
                <div class="chat-box-head">
         Chatting with <?=$username ?>

                </div>
                <div class="panel-body chat-box-main">
                    <div class="chat-box-right2">

                        <div id="result-wrapper">
                            <div id="result">
                            <?php 
                            $reciver = $_GET['reciver'];
                            include("load.php"); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <form method='post' action="#" onsubmit="return post(<?= $_GET['reciver'] ?>);" id="my_form" name="my_form">
                    <div class="chat-box-footer">
                        <div class="input-group">
                            <input type="text" style="display:none" id="userid" value="<?= $_GET['reciver'] ?>">
                            <input id="comment" name="body" type="text" class="form-control" placeholder="Enter Text Here...">
                              <span class="input-group-btn">
                               <input class="btn btn-info" onclick="godown()" type="submit" value="Send" id="btn" name="btn" >  
                              </span>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

    <?php } include('includes/footer.php'); ?>