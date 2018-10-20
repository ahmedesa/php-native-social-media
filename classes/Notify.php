<?php

class Notify {

    public static function createnotify($text = "", $postid = 0) {
        $text = explode(" ", $text);
        $notify = array();
        foreach ($text as $word) {
            if (substr($word, 0, 1) == "@") {
                $notify[substr($word, 1)] = array('type' => 1, 'extra' => '{"postbody":"' . htmlentities(implode(" ", $text)) . '"}');
            }
        }

        if (count($text) == 1 && $postid != 0) {
            $temp = DB::query('SELECT posts.user_id AS receiver, post_likes.user_id AS sender FROM posts, post_likes WHERE posts.id = post_likes.post_id AND posts.id=?', array($postid));
            $r = $temp[0]["receiver"];
            $s = $temp[0]["sender"];
        if ($r != $s) {
            DB::query('INSERT INTO notification VALUES ("",?,?,?,?)', array(2, $r, $s, ""));
            }
          
        }


        return $notify;
    }

}
