<?php
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
$P_IVA = $_POST['P_IVA'];


try{
    $check = mysql_query("SELECT name FROM Company WHERE p_iva='$P_IVA'", $conn);
    $rows = mysql_num_rows($check);
    if($rows!=0)
    {
        echo $lang['COMPANY_EXISTS'];
        header("refresh: 2 ../new_organization.php");
    }
    else
    {
        $insert = mysql_query("INSERT INTO Organization(name, address, CAP, city, commune, phone, mobile_phone, mail, reference) VALUES ('$name', '$address', '$CAP', '$city', '$commune', '$phone', '$mobile_phone', '$mail', '$reference')", $conn);
        echo $lang['INSERT_SUCCESS'];
        header("refresh: 2 ../index.php");
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>