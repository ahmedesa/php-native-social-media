<?php

include('includes/navbar.php');
include('includes/header.php');
include('classes/Notify.php');

if (login::islogged()) {
    $userid = login::islogged();
    $showtimeline = 1;
} else {
    echo "not logged in ";
}

echo "<h1>Notifications</h1>";
if (DB::query('SELECT * FROM notification WHERE reciver =? ', array($userid))) {
    $notification = DB::query('SELECT * FROM notification WHERE reciver =? ORDER BY id DESC ', array($userid));
    foreach ($notification as $n) {
        if ($n['type'] == 1) {
            $sendername = DB::query('SELECT username FROM users WHERE id = ? ', array($n['sender']))[0]['username'];
            $senderimg = DB::query('SELECT * FROM users WHERE id = ? ', array($n['sender']))[0]['profileimg'];

            if ($n['extra'] == "") {
                echo "thir is a new notification !! ";
                echo "</br>";
            } else {
                $extra = json_decode($n['extra']);
               
                echo "


<div style = ' border: 1px solid;
    border-color: #eaeaea;
    border-radius: 5px;
    background-color: white;'><img style='width: 50px;' src='".$senderimg."' >
<div`style='margin: 5px;' >
<strong>". $sendername . "</strong> mention you in a post! -" . $extra->postbody."
</div>
</div>
";
            }
        } elseif ($n['type'] == 2) {
            $sendername = DB::query('SELECT username FROM users WHERE id = ? ', array($n['sender']))[0]['username'];
            $senderimg = DB::query('SELECT * FROM users WHERE id = ? ', array($n['sender']))[0]['profileimg'];

            echo "

<div style = ' border: 1px solid;
    border-color: #eaeaea;
    border-radius: 5px;
    background-color: white;'>
<img style='width: 50px;' src='".$senderimg."' >
<div style='margin: 5px;' >
<strong>". $sendername . "</strong> like your post! -
</div>
</div>
";
            ;
        }
    }
}
 include('includes/footer.php'); 
