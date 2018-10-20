<?php

class image {

    public static function uplodeimage($fileimage,$query ,$parms) {
        
      $image = $_FILES[$fileimage];
      $imagename = $_FILES[$fileimage]['name'];
      $imagetempname = $_FILES[$fileimage]['tmp_name'];
      $imageext = explode('.', $imagename);
      $imgactualext = strtolower(end($imageext));
      $allowed = array('jpg', 'png', 'jpeg');
      if (in_array( $imgactualext, $allowed)) {
      $imagedestination = 'layout/imges/' . $imagename;
      move_uploaded_file($imagetempname, $imagedestination);
      $preparms = array($imagedestination);
     $newparms =  array_merge($preparms, $parms);
      DB::query($query,  $newparms);
      } else {
      echo 'this file extintion is wrong ';
      } 
        
    }

}