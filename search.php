<?php
include('includes/header.php');
include('includes/navbar.php');
include('classes/frindlist.php');


if (isset($_POST['search'])) {
        $tosearch = explode(" ", $_POST['searchbox']);
        if (count($tosearch) == 1) {
                $tosearch = str_split($tosearch[0], 2);
        }
        $whereclause = "";
        $paramsarray = array(':username'=>'%'.$_POST['searchbox'].'%');
        for ($i = 0; $i < count($tosearch); $i++) {
                $whereclause .= " OR username LIKE :u$i ";
                $paramsarray[":u$i"] = $tosearch[$i];
        }
        if ( DB::query('SELECT * FROM users WHERE username LIKE :username '.$whereclause.'', $paramsarray)) {
        $users = DB::query('SELECT * FROM users WHERE username LIKE :username '.$whereclause.'', $paramsarray);
        echo "  <div style = '    width: 700px;' class='members'>
              <h1 class='page-header'>You Searched For '".$_POST['searchbox']."'</h1>
              ";
        foreach ($users as $u) {
?>

              <div class="row member-row">
                <div class="col-md-3">
                  <img style="    width: 200px;" src="<?php echo $u['profileimg'] ?>" class="img-thumbnail" alt="">
                  <div class="text-center">
                  <?php echo $u['username']; ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <p><a href="chat.php?reciver=<?php echo $u['id'] ?>" class="btn btn-default btn-block"><i class="fa fa-envelope"></i> Send Message</a></p>
                </div>
                <div class="col-md-3">
                  <p><a href="profile.php?username=<?php echo $u['username'] ?> " class="btn btn-primary btn-block"><i class="fa fa-edit"></i> View Profile</a></p>
                </div>
              </div>
<?php
        }

        echo "</div>";
    }else{


     echo "  <div style = '    width: 800px;' class='members'>
              <h1 class='page-header'>You Searched For '".$_POST['searchbox']."'</h1>
              <h1> There Is No User With That Name </hr>
              </div>
              ";


    }

}

?>



  <?php  include('includes/footer.php'); ?>
