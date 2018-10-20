<?php
class login {
public static function islogged() {
if(isset($_COOKIE['SNID'])){
	 if (DB::query('SELECT user_id FROM login_tokens WHERE token = ? ', array(sha1($_COOKIE['SNID'])))) {
			$userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
			return $userid;
  }}

return false ;
}
}

?>