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
$organization_id = $_POST['organization_id'];
$points = $_POST['points'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$date = $year."-".$month."-".$day;
$query= "INSERT INTO Volunteering(boy_id,organization_id,points,vol_date) VALUES ('$boy_id','$organization_id','$points','$date')";
try{
    $check = mysql_query("SELECT org_id FROM Organization WHERE org_id='$organization_id'", $conn);
    $rows = mysql_num_rows($check);
    if($rows==0)
    {
        echo $lang['ORGANIZATION_DONOT_EXISTS'];
        echo ('<meta http-equiv="refresh" content="1; url=../view_boy.php?boy_id='.$boy_id.'">');
    }
    else
    {    
        mysql_query($query);
        echo $lang['INSERT_SUCCESS'];
        echo ('<meta http-equiv="refresh" content="1; url=../view_boy.php?boy_id='.$boy_id.'">');
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>
