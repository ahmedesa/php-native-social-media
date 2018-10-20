<?php

class frindlist {

        public static function display($userid){
 $thelist = DB::query('SELECT followers.followe_id ,users.username, users.profileimg 
FROM users, followers 
WHERE followe_id = ?
AND followers.user_id = users.id
', array($userid));
 $frindlis = "" ;
                foreach($thelist as $f) {
               
$frindlis .= '  <li><a href="profile.php?username='.$f['username'].'" class="thumbnail"><img src="'.$f['profileimg'].'" alt=""></a></li>' ;



                }
                return $frindlis;     
    }




        public static function displaynum($userid){
 $thelist = DB::query('SELECT followers.followe_id ,users.username, users.profileimg 
FROM users, followers 
WHERE followe_id = ?
AND followers.user_id = users.id
', array($userid));
 $frindlis = 0 ;
                foreach($thelist as $f) {
               
$frindlis ++;



                }
                return $frindlis;     
    }
















}