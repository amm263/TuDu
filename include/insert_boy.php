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
$name = $_POST['name'];
$surname = $_POST['surname'];
$address = $_POST['address'];
$commune = $_POST['commune'];
$CAP = $_POST['CAP'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$date_of_birth = $year."-".$month."-".$day;
$phone = $_POST['phone'];
$mobile_phone = $_POST['mobile_phone'];
$mail = $_POST['mail'];


try{
    $check = mysql_query("SELECT name FROM Boy WHERE name='$name' AND surname='$surname' AND date_of_birth='$date_of_birth' AND mobile_phone='$mobile_phone'", $conn);
    $rows = mysql_num_rows($check);
    if($rows!=0)
    {
        echo $lang['BOY_EXISTS'];
        echo ('<meta http-equiv="refresh" content="1; url=../new_boy.php">');
    }
    else
    {
       $insert = mysql_query("INSERT INTO Boy(name, surname, address, CAP, commune, date_of_birth, phone, mobile_phone, mail) VALUES ('$name', '$surname', '$address', '$CAP', '$commune', '$date_of_birth', '$phone', '$mobile_phone', '$mail')", $conn);
       echo $lang['INSERT_SUCCESS'];
       echo ('<meta http-equiv="refresh" content="1; url=../index.php">');
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>