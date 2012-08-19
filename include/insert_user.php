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
