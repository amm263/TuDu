<?php
/*
*	Copyright 2012, Andrea Mazzotti <amm263@gmail.com>
*
*	Permission to use, copy, modify, and/or distribute this software for any purpose with or without fee is hereby granted,
*	provided that the above copyright notice and this permission notice appear in all copies.
*
*	THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE 
*	INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR 
*	ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS 
* 	OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING 
*	OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
*
*/
include ('connect.php');
$psw = md5($_POST['password']);
$user = $_POST['user'];

/*  
 *  file: session.php
 * 
 *  Sets up the Session for the user after the login
 */
try{
    $login = mysql_query("SELECT user FROM Account WHERE user= '$user' AND password= '$psw' ", $conn);
    $rows = mysql_num_rows($login);
    if ($rows == 1)
    {
        $result = mysql_query("SELECT privilege,locale FROM Account WHERE user = '$user' AND password= '$psw' ", $conn);
        $result = mysql_fetch_array($result);
        session_start();
        $_SESSION['privilege']= $result['privilege'];
        $_SESSION['locale']= $result['locale'];
        $_SESSION['user']= $user;
        echo ('<meta http-equiv="refresh" content="1; url=../index.php">');
    }
    else
    {
        echo 'Login Failed!';
        echo ('<meta http-equiv="refresh" content="1; url=../login.php">');
    }
}
catch(Excepiton $f){
    echo 'Error: '.$f->getMessage()."\n";
}
?>
