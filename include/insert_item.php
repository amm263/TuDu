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
$company_id = $_POST['company_id'];
$price = $_POST['price'];
$points = $_POST['points'];
$name = $_POST['name'];
$query= "INSERT INTO Item(company_id,name,price,points) VALUES ('$company_id','$name','$price','$points')";
try{
mysql_query($query);
echo $lang['INSERT_SUCCESS'];
echo ('<meta http-equiv="refresh" content="1; url=../view_company.php?p_iva='.$company_id.'">');
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>