<?php

class comment {

    public static function creatcomment($commentbody, $postid, $userid) {
        DB::query('INSERT INTO comments VALUES("",?,?,NOW(),?)', array($commentbody, $userid, $postid));
    }

    public static function display($postid) {
 $comments = DB::query('SELECT comments.posted_at ,  comments.comment,users.profileimg ,users.username FROM comments, users WHERE post_id = ? AND comments.user_id = users.id', array($postid));
 $comm = "" ;
 $count =0;
                foreach($comments as $c) {
                  $count++;
                  $date =date('d-M-Y h:i a', strtotime($c['posted_at']));

                      $comm .= "


					    <div class='comment'>
                           <strong>".$c['username']." </strong>  


					<div class='col-sm-1'>
                            <a href='profile.php?username=".$c['username']."' class='post-avatar thumbnail'>
                            <img src='".$c['profileimg']."' alt=''>
        
                           </a>
                        </div>
  <span style = 'color: cadetblue;' >
           posted at ".$date."
  </span>
                         <div class='comment-text'>
                           <p> " .$c['comment']." </p>
                         </div>
                       </div>
                       <div class='clearfix'></div> 



  


";



                }
                return $comm ;     
    }

}