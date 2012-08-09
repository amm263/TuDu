<?php
include ('connect.php');
include ('../locale/it.php');
$name = $_POST['name'];
$surname = $_POST['surname'];
$address = $_POST['address'];
$CAP = $_POST['CAP'];
$city = $_POST['city'];
$city_of_birth = $_POST['city_of_birth'];
$phone = $_POST['phone'];
$mobile_phone = $_POST['mobile_phone'];
$mail = $_POST['mail'];
$codice_fiscale = $_POST['codice_fiscale'];


try{
    $check = mysql_query("SELECT codice_fiscale FROM Boy WHERE codice_fiscale='$codice_fiscale'", $conn);
    $rows = mysql_num_rows($check);
    if($rows!=0)
    {
        echo $lang['BOY_EXISTS'];
        header("refresh: 2 ../new_boy.php");
    }
    else
    {
        $insert = mysql_query("INSERT INTO Boy(name, surname, address, CAP, city, city_of_birth, phone, mobile_phone, mail, codice_fiscale) VALUES ('$name', '$surname', '$address', '$CAP', '$city', '$city_of_birth', '$phone', '$mobile_phone', '$mail', '$codice_fiscale')", $conn);
        echo $lang['INSERT_SUCCESS'];
        header("refresh: 2 ../index.php");
    }
}
catch(Exception $e)
{
    echo 'Error:'.$e->getMessage();
}
?>