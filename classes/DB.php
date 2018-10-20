<?php
class DB {
private static function connect(){


$usernamed = "root";
$passwordd = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=socialnetwork", $usernamed, $passwordd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

	return $conn ;
}

public static function query($query ,$parms = array()){
$statment = self::connect()->prepare($query);
$statment->execute($parms);
$words = explode(' ',  $query);
if ($words[0] == 'SELECT' ){
$data = $statment->fetchAll();
return $data;

}


}}

