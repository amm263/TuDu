<?php
include ('connect.php');
include ('../locale/it.php');
$name = $_POST['name'];
$reference = $_POST['reference'];
$address = $_POST['address'];
$CAP = $_POST['CAP'];
$city = $_POST['city'];
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
        $insert = mysql_query("INSERT INTO Company(name, address, CAP, city, phone, mobile_phone, mail, reference, p_iva) VALUES ('$name', '$address', '$CAP', '$city', '$phone', '$mobile_phone', '$mail', '$reference', '$P_IVA')", $conn);
        echo $lang['INSERT_SUCCESS'];
        header("refresh: 2 ../index.php");
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>