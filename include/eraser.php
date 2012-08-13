<?php
include ('connect.php');
include ('../locale/it.php');
$table = $_POST['table'];
$key = $_POST['key'];
$value = $_POST['key_value'];
try{
    mysql_query("DELETE FROM tudu_db.$table WHERE $key = '$value'");
    echo $lang['DELETE_SUCCESS'];
    header("refresh: 1 ../index.php");
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>
