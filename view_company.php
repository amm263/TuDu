<!DOCTYPE html>
<?php
include('include/navbar.php');
include('locale/it.php');
include('include/connect.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div id="ContentContainer">
            <div id="Header">
                <?php //getHeader(); ?>
            </div>   
            <div id="Navbar">
                <?php getBar(); ?>
            </div>
            <div id="Content">
                <?php 
                include('include/privilege_check.php');
                if(check('admin')||check('manager'))
                {
                    if(isset($_GET['p_iva']))
                    {
                        $p_iva = $_GET['p_iva'];
                        try{
                        $result = mysql_query("SELECT * FROM Company WHERE p_iva='$p_iva'",$conn);
                        if(mysql_num_rows($result)==1)
                        {
                            echo "<strong>".mysql_result($result, 0, 'name')."</strong><br />";
                            echo $lang['P_IVA'].": ".mysql_result($result, 0, 'p_iva')."<br />";
                            if(check('admin'))
                            { 
                                echo $lang['ADDRESS'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'address').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="address"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';                            
                                echo $lang['COMMUNE'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'commune').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="commune"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';                            
                                echo $lang['CITY'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'city').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="city"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';
                                echo $lang['CAP'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'CAP').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="CAP"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form><br />';
                                echo $lang['PHONE'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'phone').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="phone"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';
                                echo $lang['MOBILE_PHONE'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mobile_phone').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="mobile_phone"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';
                                echo $lang['MAIL'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mail').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';
                                echo $lang['REFERENCE'].'<form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'reference').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form>';
                                }
                            else
                            {
                                echo $lang['ADDRESS'].": ".mysql_result($result, 0, 'address')."<br />";
                                echo $lang['COMMUNE'].": ".mysql_result($result, 0, 'commune')."<br />";
                                echo $lang['CITY'].": ".mysql_result($result, 0, 'city')."<br />";
                                echo $lang['CAP'].": ".mysql_result($result, 0, 'CAP')."<br />";
                                echo $lang['PHONE'].": ".mysql_result($result, 0, 'phone')."<br />";
                                echo $lang['MOBILE_PHONE'].": ".mysql_result($result, 0, 'mobile_phone')."<br />";
                                echo $lang['MAIL'].": ".mysql_result($result, 0, 'mail')."<br />";
                                echo $lang['REFERENCE'].": ".mysql_result($result, 0, 'reference')."<br />";
                            }
                            echo '<br />';
                            echo '<form action="list_token.php" name = "vol_form" method="post"><input type="hidden" name="search_type" value="company_id"><input type="hidden" name="search_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['LIST_TOKEN'].'" /></form>';
                            echo '<form action="list_token.php" name = "vol_form" method="post">'.$lang['START_DATE'].'<input type="text" name="date_start" value="YYYY-MM-DD"> '.$lang['END_DATE'].'<input type="text" name="date_end" value="YYYY-MM-DD"><input type="hidden" name="search_type" value="company_id"><input type="hidden" name="search_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['LIST_TOKEN'].'" /></form>';                       
                            echo '<form action="list_invoice.php" name = "vol_form" method="post"><input type="hidden" name="search_type" value="company_id"><input type="hidden" name="search_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['LIST_INVOICE'].'" /></form>';
                            echo '<form action="list_invoice.php" name = "vol_form" method="post">'.$lang['START_DATE'].'<input type="text" name="date_start" value="YYYY-MM-DD"> '.$lang['END_DATE'].'<input type="text" name="date_end" value="YYYY-MM-DD"><input type="hidden" name="search_type" value="company_id"><input type="hidden" name="search_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['LIST_INVOICE'].'" /></form>';
                            echo '<form action="list_item.php" name = "vol_form" method="post"><input type="hidden" name="search_type" value="company_id"><input type="hidden" name="search_value" value="'.$p_iva.'"><input type="submit" name="submit"  value ="'.$lang['LIST_ITEM'].'" /></form>';
                            
                        }
                        else
                            $lang['NO_RESULTS'];
                        }
                        catch(Exception $e)
                        {
                            echo 'Error:'.$e->getMessage();
                        }
                    }
                }
                else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
