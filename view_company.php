<!DOCTYPE html>
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
 *  file: view_company.php
 *  
 *  Page showing all the proprieties for a given Company
 * 
 */
include('include/header.php');
include('include/navbar.php');
include('locale/it.php');
include('include/connect.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $lang['COMPANY']; ?></title>
    </head>
    <body>
        <div id="ContentContainer">
            <div id="Header">
                <?php getHeader(); ?>
            </div>   
            <div id="Navbar">
                <?php getBar(); ?>
            </div>
            <div id="Content">
                <?php 
                // Check for account privileges
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
                            echo "<h1 style=\"text-align: center;\">".mysql_result($result, 0, 'name')."</h1><br /><br />";
                            echo "<h3>".$lang['P_IVA'].": ".mysql_result($result, 0, 'p_iva')."</h3><br />";
                            // All the admins can modify the properties of the given Company
                            if(check('admin'))
                            { 
                                echo '<table id="invisibleTable">';
                                echo '<tr><td id="itd"><strong>'.$lang['ADDRESS'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'address').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="address"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';                            
                                echo '<tr><td id="itd"><strong>'.$lang['COMMUNE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'commune').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="commune"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';                            
                                echo '<tr><td id="itd"><strong>'.$lang['CITY'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'city').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="city"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['CAP'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'CAP').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="CAP"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['PHONE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'phone').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="phone"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['MOBILE_PHONE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mobile_phone').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="mobile_phone"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['MAIL'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mail').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['REFERENCE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'reference').'"/><input type="hidden" name="table" value="Company"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="p_iva"><input type="hidden" name="key_value" value="'.$p_iva.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '</table>';
                            }
                            else
                            {
                                echo '<table id="invisibleTable">';
                                echo '<tr><td id="itd"><strong>'.$lang['ADDRESS'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'address')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['COMMUNE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'commune')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['CITY'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'city')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['CAP'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'CAP')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['PHONE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'phone')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['MOBILE_PHONE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'mobile_phone')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['MAIL'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'mail')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['REFERENCE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'reference')."</td></tr>";
                                echo '</table>';  
                            }
                            echo '<br /><br />';
                            
                            
                            echo '<h3>'.$lang['LIST_TOKEN'].'</h3>';
                            // Token search form
                            echo '<form action="list_token.php" method="post">
                                    <input type="hidden" name="search_type" value="company_id">
                                    <input type="hidden" name="search_value" value="'.$p_iva.'">
                                    <input type="submit" name="submit"  value ="'.$lang['TOTAL_TOKEN'].'" />
                                  </form><br /><br />';
                            // Token search form (DATE filter)
                            echo '<form action="list_token.php"  method="post">'
                                    .$lang['START_DATE'].': <input type="text" name="date_start" value="YYYY-MM-DD"> '
                                    .$lang['END_DATE'].': <input type="text" name="date_end" value="YYYY-MM-DD">
                                    <input type="hidden" name="search_type" value="company_id">
                                    <input type="hidden" name="search_value" value="'.$p_iva.'">
                                    <input type="submit" name="submit"  value ="'.$lang['DATE_TOKEN'].'" />
                                  </form><br /><br />';                       
                            
                            echo '<h3>'.$lang['LIST_INVOICE'].'</h3>';
                            // Invoice search form
                            echo '<form action="list_invoice.php"  method="post">
                                        <input type="hidden" name="search_type" value="company_id">
                                        <input type="hidden" name="search_value" value="'.$p_iva.'">
                                        <input type="submit" name="submit"  value ="'.$lang['TOTAL_INVOICE'].'" />
                                  </form><br /><br />';
                            // Invoice search form (DATE filter)
                            echo '<form action="list_invoice.php"  method="post">'
                                    .$lang['START_DATE'].': <input type="text" name="date_start" value="YYYY-MM-DD"> '
                                    .$lang['END_DATE'].': <input type="text" name="date_end" value="YYYY-MM-DD">
                                    <input type="hidden" name="search_type" value="company_id">
                                    <input type="hidden" name="search_value" value="'.$p_iva.'">
                                    <input type="submit" name="submit"  value ="'.$lang['DATE_INVOICE'].'" />
                                  </form><br /><br />';
                            
                            // Item search form
                            echo '<h3>'.$lang['LIST_ITEM'].'</h3>';
                            echo '<form action="list_item.php" name = "vol_form" method="post">
                                    <input type="hidden" name="search_type" value="company_id">
                                    <input type="hidden" name="search_value" value="'.$p_iva.'">
                                    <input type="submit" name="submit"  value ="'.$lang['TOTAL_ITEM'].'" />
                                  </form><br /><br />';
                            
                            // Insert of a new Invoice row
                            echo '<h3>'.$lang['NEW_INVOICE_TITLE'].'</h3>';
                            echo '<form action="include/insert_invoice.php" name= "invoice_form" method="post" onsubmit="return validateInv()">'
                                    .$lang['PRICE'].': <input type="text" name="amount">€<input type="hidden" name="company_id" value="'.mysql_result($result, 0, 'p_iva').'"><br />'
                                    .$lang['DATE'].': <select name="day">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                    </select>
                                                    <select name="month">
                                                            <option value=1>'.$lang['JANUARY'].'</option>
                                                            <option value=1>'.$lang['FEBRUARY'].'</option>
                                                            <option value=1>'.$lang['MARCH'].'</option>
                                                            <option value=1>'.$lang['APRIL'].'</option>
                                                            <option value=1>'.$lang['MAY'].'</option>
                                                            <option value=1>'.$lang['JUNE'].'</option>
                                                            <option value=1>'.$lang['JULY'].'</option>
                                                            <option value=1>'.$lang['AUGUST'].'</option>
                                                            <option value=1>'.$lang['SEPTEMBER'].'</option>
                                                            <option value=1>'.$lang['OCTOBER'].'</option>
                                                            <option value=1>'.$lang['NOVEMBER'].'</option>
                                                            <option value=1>'.$lang['DECEMBER'].'</option>
                                                    </select>
                                                    <input type="text" name="year" value="YYYY"><br />'.
                                    '<input type="submit" name="submit"  value ="'.$lang['NEW_INVOICE'].'" /></form><br /><br />';
                            
                            // Insert of a new Item
                            echo '<h3>'.$lang['NEW_ITEM_TITLE'].'</h3>';
                            echo '<form action="include/insert_item.php" name= "item_form" method="post" onsubmit= "return validateItem()">'.
                                    '<table id="invisibleTable">'.
                                        '<tr><td id="itd"><strong>'.$lang['PRICE'].':</strong></td><td id="itd"> <input type="text" name="price">€</td></tr>'.
                                        '<tr><td id="itd"><strong>'.$lang['POINTS'].':</strong></td><td id="itd"> <input type="text" name="points"></td></tr>'.
                                        '<tr><td id="itd"><strong>'.$lang['NAME'].':</strong></td><td id="itd"> <input type="text" name="name"><input type="hidden" name="company_id" value="'.mysql_result($result, 0, 'p_iva').'"></td></tr>
                                        <tr><td id="itd"><input type="submit" name="submit"  value ="'.$lang['NEW_ITEM'].'" /></td></tr>
                                    </table></form><br /><br />';
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
        <script type="text/javascript">
        function validateInv(){
            
            var p = document.forms['invoice_form']['amount'].value;
            if(p == null || p == "" || isNaN(p)){
                    alert ("Amount can not be empty!");
                    return false;
            }
            
            var u = document.forms['invoice_form']['year'].value;
            if(u == null || u == "" || isNaN(u) || u>3000 || u<1900 ){
                    alert ("Year not valid!");
                    return false;
            }
        }
        
        function validateItem(){
            
            var p = document.forms['item_form']['price'].value;
            if(p == null || p == "" || isNaN(p)){
                    alert ("Price can not be empty!");
                    return false;
            }
            
            var p = document.forms['item_form']['points'].value;
            if(p == null || p == "" || isNaN(p)){
                    alert ("Points can not be empty!");
                    return false;
            }
            
            var p = document.forms['item_form']['name'].value;
            if(p == null || p == ""){
                    alert ("Name can not be empty!");
                    return false;
            }
        }
        </script>
    </body>
</html>
