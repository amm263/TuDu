<?php
$host = "127.0.0.1";
$pass = "";
$user = "root";
$db = "tudu_db";

try {
    $conn =  mysql_connect($host , $user , $pass) or die(mysql_error());
	mysql_select_db($db , $conn) or die(mysql_error());
}
catch(Exception $e){
    echo 'Error: ' , $e->getMessage(),"\n";
	header("refresh: 2 index.php");
}
?>