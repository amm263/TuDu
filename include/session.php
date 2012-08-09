<?php
include ('connect.php');
$psw = md5($_POST['password']);
$user = $_POST['user'];

try{
    $login = mysql_query("SELECT user FROM Account WHERE user= '$user' AND password= '$psw' ", $conn);
    $rows = mysql_num_rows($login);
    if ($rows == 1)
    {
        $result = mysql_query("SELECT privilege,locale FROM account WHERE user = '$user' AND password= '$psw' ", $conn);
        $result = mysql_fetch_array($result);
        session_start();
        $_SESSION['privilege']= $result['privilege'];
        $_SESSION['locale']= $result['locale'];
        $_SESSION['user']= $user;
        header("refresh: 0 ../index.php");
    }
    else
    {
        echo 'Login Failed!';
        header("refresh: 2 ../login.php");
    }
}
catch(Excepiton $f){
    echo 'Error: '.$f->getMessage()."\n";
}
?>
