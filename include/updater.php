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

/*  
 *  file: updater.php
 * 
 *  Updates the selected column, in the selected row, in the selected table, with the new value given.
 */
include ('connect.php');
include ('../locale/it.php');
$table = $_POST['table'];
$column = $_POST['column'];
$update = $_POST['update'];
$key = $_POST['key'];
$key_value = $_POST['key_value'];
try{
    mysql_query("UPDATE tudu_db.$table SET $column = '$update' WHERE $key = '$key_value'");
    echo $lang['UPDATE_SUCCESS'];
    header("refresh: 1 ../index.php");
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>
