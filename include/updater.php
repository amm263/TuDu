<?php
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
