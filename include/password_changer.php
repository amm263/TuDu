<?php
include ('connect.php');
include ('../locale/it.php');
$current_psw = md5($_POST['current_password']);
$new_psw = md5($_POST['new_password']);
$user = $_POST['user'];
try{
    $login = mysql_query("SELECT user FROM Account WHERE user= '$user' AND password= '$current_psw' ", $conn);
    $rows = mysql_num_rows($login);
    if ($rows == 1)
    {
        mysql_query("UPDATE tudu_db.Account SET password='$new_psw' WHERE user = '$user' ", $conn);
        echo $lang['UPDATE_SUCCESS'];
        header("refresh: 2 ../index.php");
    }
    else
    {
        echo 'Wrong Password!';
        header("refresh: 2 ../change_password.php");
    }
}
catch(Excepiton $f){
    echo 'Error: '.$f->getMessage()."\n";
}
?>

