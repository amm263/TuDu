<?php
include ('connect.php');
include ('../locale/it.php');
$psw = md5($_POST['password']);
$user = $_POST['user'];
$privilege = $_POST['privilege'];

try{
    $check = mysql_query("SELECT user FROM Account WHERE user='$user'", $conn);
    $rows = mysql_num_rows($check);
    if($rows!=0)
    {
        echo $lang['USER_EXISTS'];
        header("refresh: 2 ../new_user.php");
    }
    else
    {
        $insert = mysql_query("INSERT INTO Account(privilege, user, password) VALUES ('$privilege','$user','$psw')", $conn);
        echo $lang['INSERT_SUCCESS'];
        header("refresh: 2 ../index.php");
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>
