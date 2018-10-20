<?php
class post {
    /*     * *************************************************************
     *   function to creat post                                     *
     * ************************************************************** */

// $key -> is the person who recive the mention
// $n   -> is the type of the notefication
    public static function creatpost($postbody, $loggeduserid, $profileuserid) {
        $topics = self::gettopics($postbody);
        if ($profileuserid == $loggeduserid) {
            if (count(Notify::createnotify($postbody)) != 0) {
                foreach (Notify::createnotify($postbody) as $key => $n) {
                    $s = $loggeduserid;
                    $r = DB::query('SELECT id FROM users WHERE username = ?', array($key))[0]['id'];
                    if ($r != 0) {
                        DB::query('INSERT INTO notification VALUES ("",?,?,?,?)', array($n["type"], $r, $s, $n["extra"]));
                    }
                }
            }
            DB::query('INSERT INTO posts VALUES("",?,NOW(),?,0,"",?)', array($postbody, $profileuserid, $topics));
        } else {
            echo "can't post in this profile";
        }
    }

    /*     * *************************************************************
     *   function to make like to post                                 *
     * ************************************************************** */

    public static function likepost($postid, $liker) {
        if (!DB::query('SELECT user_id FROM post_likes WHERE post_id =? AND user_id = ? ', array($postid, $liker))) {
            DB::query('UPDATE posts SET likes = likes+1 WHERE id =? ', array($postid));
            DB::query('INSERT INTO post_likes VALUES("",?,?)', array($postid, $liker));
            Notify::createnotify("", $postid);
        } else {
            DB::query('UPDATE posts SET likes = likes-1 WHERE id =? ', array($postid));
            DB::query('DELETE FROM post_likes WHERE post_id = ? AND user_id = ? ', array($postid, $liker));
        }
    }

    /*     * *************************************************************
     *   function to post a posts to topics page                    *
     * ************************************************************** */

    public static function gettopics($text) {
        $text = explode(" ", $text);
        $topics = "";

        foreach ($text as $word) {
            if (substr($word, 0, 1) == "#") {
                $topics .= substr($word, 1) . ",";
            }
        }

        return $topics;
    }

    /*     * *************************************************************
     *   function to make a hashes and mention as a link            *
     * ************************************************************** */

    public static function link_add($text) {
        $text = explode(" ", $text);
        $newstring = "";
        foreach ($text as $word) {
            if (substr($word, 0, 1) == "@") {

                $newstring .= "<a  href='profile.php?username=" . substr($word, 1) . "'>" . htmlspecialchars($word) . "</a> ";
            } elseif (substr($word, 0, 1) == "#") {
                $newstring .= "<a  href='topic.php?topic=" . substr($word, 1) . "'>" . htmlspecialchars($word) . "</a> ";
            } else {
                $newstring .= htmlspecialchars($word) . " ";
            }
        }

        return $newstring;
    }

    /*     * *************************************************************
     *   function to display posts                                  *
     * ************************************************************** */

    public static function display($userid = null, $username = null, $loggeduserid = null , $profile = null , $topic = null) {
        if (isset($profile)) {
$dbposts = DB::query('SELECT posts.id, posts.posted_time , posts.body, posts.likes, posts.postimg ,posts.user_id , users.profileimg ,  users.`username` FROM users, posts  WHERE user_id = ? AND users.id = posts.user_id ORDER BY id DESC ', array($userid));
        }elseif (isset($topic)) {

  $dbposts = DB::query('SELECT posts.id, posts.posted_time , posts.body, posts.likes, posts.postimg ,posts.user_id , users.profileimg ,  users.`username` FROM users, posts  WHERE FIND_IN_SET(?,posts.topics) AND users.id = posts.user_id ORDER BY id DESC ', array($topic));
        }else {
$dbposts = DB::query('SELECT posts.id, posts.posted_time , posts.body, posts.likes,
posts.postimg ,posts.user_id , users.profileimg , users.username
FROM users, posts, followers
WHERE posts.user_id = followers.user_id
AND users.id = posts.user_id
AND followe_id = ?
ORDER BY posts.id DESC;', array($userid));



        }
            
            
            $posts = "";
            foreach ($dbposts as $p) {
$date =date('d-M-Y h:i a', strtotime($p['posted_time']));
                if (!DB::query('SELECT post_id FROM post_likes WHERE post_id =? AND user_id = ? ', array($p['id'], $loggeduserid))) {
                    $comment = comment::display($p['id']);


                    $posts .= " <div style = 'width : 888px;' >

        <div  class='panel panel-default post'>
            <form action='" . $_SERVER['PHP_SELF'] . "?username=$username&postid=" . $p['id'] . "'  method='post'>

                <div class='panel-body'>
                    <div class='row'>
";
                    if ($p['user_id'] == $loggeduserid) {


                        $posts .= " 
  <button style=' margin: 5px; ' type='button' class='close' data-toggle='modal' data-target='#myModal'>x</button> 
  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog'>
    <div class='modal-dialog '>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Delete The Post</h4>
        </div>
        <div class='modal-body'>
          <p>Are You Sure you Want To Delete This Post</p>
        </div>
        <div  class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
             <input class='btn btn-info' aria-label='Close' type='submit' name='deletepost' value='confirm' />
        </div>
      </div>
    </div>
  </div>


  ";
                    }

                    $posts .= "  
  <span style = 'color: cadetblue;' >
           posted at ".$date."
  </span>

                        <div class='col-sm-2'>
                            <a href='profile.php?username=".$p['username']."' class='post-avatar thumbnail'>
                            <img src='".$p['profileimg']."' alt=''>
        
                            <div class='text-center'>".$p['username']."</div></a>
                        </div>
                        <div class='col-sm-10'>
                            <div class='bubble'>
                                <div class='pointer'>
";
                    if (file_exists($p['postimg'])) {
                        $posts .= "  
<img style='width:100px;height:100px;' src='" . $p['postimg'] . "'>";
                        echo "<br>";
                    }


                    $posts .= "                                    <br>
                                    <p>" . self::link_add($p['body']) . "</p>
                                </div>
                                <div class='pointer-border'></div>
                            </div>
                            <br>

                            <button type='button' value ='".$p['id']."' class='btn btn-primary  like'>LIKE</button>
<span class='pull-right text-muted ' >
    <span id='show_like".$p['id']."'  >".$p['likes']."</span>
     likes 
    </span>

                                        <br>

                            <div class='clearfix'></div>
            </form>

     </form>
            </div>
            </div>
            <br>
              <div class='comment-form'>
                      <form action = '" . $_SERVER['PHP_SELF'] . "?username=$username&postid2=" . $p['id'] . " ' method ='post' class='form-inline'>
                          <div class='input-group'>
    <input style=' width: 750px;' type='text' name ='commentbody' class='form-control' placeholder='enter comment'>
      <div class='input-group-btn'>
       <input type='submit' class='btn btn-primary' name = 'comment' value = 'comment' >
      </div>
    </div>
                      </form>
                     </div>
                     <div class='clearfix'></div>

                     <div class='comments'>
                                         " . $comment . "

                     </div>
            </div>
        </div>
    </div>
    <br>
        <br>

    ";
                } else {

                    $comment = comment::display($p['id']);

                    $posts .= " <div style = 'width : 888px;' >

        <div class='panel panel-default post'>
            <form action='" . $_SERVER['PHP_SELF'] . "?username=$username&postid=" . $p['id'] . "'  method='post'>

                <div class='panel-body'>
                    <div class='row'>

";
                    if ($p['user_id'] == $loggeduserid) {


  $posts .= " 
  <button style=' margin: 5px; ' type='button' class='close' data-toggle='modal' data-target='#myModal'>x</button> 

  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog'>
    <div class='modal-dialog '>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Delete The Post</h4>
        </div>
        <div class='modal-body'>
          <p>Are You Sure you Want To Delete This Post</p>
        </div>
        <div  class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
             <input class='btn btn-info' aria-label='Close' type='submit' name='deletepost' value='confirm' />
        </div>
      </div>
    </div>
  </div>


  ";
                            }

  
                    $posts .= "  
  <span style = 'color: cadetblue;' >
           posted at ".$date."
  </span>

                        <div class='col-sm-2'>
                            <a href='profile.php?username=".$p['username']."' class='post-avatar thumbnail'>
                            <img src='".$p['profileimg']."' alt=''>
        
                            <div class='text-center'>".$p['username']."</div></a>
                        </div>
                        <div class='col-sm-10'>
                            <div class='bubble'>
                                <div class='pointer'>
";
                    if (file_exists($p['postimg'])) {
                        $posts .= "  
<img style='width:100px;height:100px;' src='" . $p['postimg'] . "'>";
                        echo "<br>";
                    }


                    $posts .= "                                    <br>
                                    <p>" . self::link_add($p['body']) . "</p>
                                </div>
                                <div class='pointer-border'></div>
                            </div>
                            <br>

                            <button type='button' value ='".$p['id']."' class='btn btn-primary  unlike'>UNLIKE</button>
<span class='pull-right text-muted ' >
    <span id='show_like".$p['id']."'  >".$p['likes']."</span>
     likes 
    </span>

                                        <br>

                            <div class='clearfix'></div>
            </form>

     </form>
     <br>
            </div>
            </div>
              <div class='comment-form'>
                      <form action = '" . $_SERVER['PHP_SELF'] . "?username=$username&postid2=" . $p['id'] . " ' method ='post' class='form-inline'>
                                    <div class='input-group'>
    <input style=' width: 750px;' type='text' name ='commentbody' class='form-control' placeholder='enter comment'>
      <div class='input-group-btn'>
       <input type='submit' class='btn btn-primary' name = 'comment' value = 'comment' >
      </div>
    </div>
                      </form>
                     </div>

                     <div class='comments'>
                                         " . $comment . "

                     </div>
            </div>
        </div>
    </div>
    

    ";
                }
            }

            return $posts;
        
    }

    /*     * *************************************************************
     *   function to uplode apost whith image                       *
     * ************************************************************** */

    public static function creatimg($postbody, $loggeduserid, $profileuserid) {
        $topics = self::gettopics($postbody);

        if ($profileuserid == $loggeduserid) {
            if (count(Notify::createnotify($postbody)) != 0) {
                foreach (Notify::createnotify($postbody) as $key => $n) {
                    $s = $loggeduserid;
                    $r = DB::query('SELECT id FROM users WHERE username = ?', array($key))[0]['id'];
                    if ($r != 0) {
                        DB::query('INSERT INTO notification VALUES ("",?,?,?,?)', array($n["type"], $r, $s, $n["extra"]));
                    }
                }
            }
            DB::query('INSERT INTO posts VALUES("",?,NOW(),?,0,"",?)', array($postbody, $profileuserid, $topics));
            $postid = DB::query('SELECT id FROM posts WHERE user_id= ? ORDER BY ID DESC LIMIT 1;', array($loggeduserid))[0]['id'];
            return $postid;
        } else {
            echo "can't post in this profile";
        }
    }

}

?>
