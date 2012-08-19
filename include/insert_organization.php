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
$reference = $_POST['reference'];
$address = $_POST['address'];
$CAP = $_POST['CAP'];
$city = $_POST['city'];
$commune = $_POST['commune'];
$phone = $_POST['phone'];
$mobile_phone = $_POST['mobile_phone'];
$mail = $_POST['mail'];


try{
    $check = mysql_query("SELECT name FROM Organization WHERE name='$name' AND city='$city'", $conn);
    $rows = mysql_num_rows($check);
    if($rows!=0)
    {
        echo $lang['ORGANIZATION_EXISTS'];
        header("refresh: 2 ../new_organization.php");
    }
    else
    {
        $insert = mysql_query("INSERT INTO Company(name, address, CAP, city, commune, phone, mobile_phone, mail, reference, p_iva) VALUES ('$name', '$address', '$CAP', '$city', '$commune', '$phone', '$mobile_phone', '$mail', '$reference', '$P_IVA')", $conn);
        echo $lang['INSERT_SUCCESS'];
        header("refresh: 2 ../index.php");
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>