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
$boy_id = $_POST['boy_id'];
$boy_surname = $_POST['boy_surname'];
$organization_id = $_POST['organization_id'];
$organization_name = mysql_result(mysql_query("SELECT name FROM Organization WHERE org_id = $organization_id"), 0, 'name');
$points = $_POST['points'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$date = $year."-".$month."-".$day;
$query= "INSERT INTO Volunteering(boy_id,boy_surname,organization_id,organization_name,points,vol_date) VALUES ('$boy_id','$boy_surname','$organization_id','$organization_name','$points','$date')";
try{
mysql_query($query);
echo $lang['INSERT_SUCCESS'];
header("refresh: 2 ../view_boy.php?codice_fiscale=$boy_id");
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>