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
 *  file: view_organization.php
 *  
 *  Page showing all the proprieties for a given Organization
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
        <title><?php echo $lang['ORGANIZATION']; ?></title>
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
                    if(isset($_GET['org_id']))
                    {
                        $org_id = $_GET['org_id'];
                        try{
                        $result = mysql_query("SELECT * FROM Organization WHERE org_id='$org_id'",$conn);
                        if(mysql_num_rows($result)==1)
                        {
                            echo "<h1 style=\"text-align: center;\">".mysql_result($result, 0, 'name')."</h1><br /><br />";  
                            // All the admins can modify the properties of the given Organization
                            if(check('admin'))
                            { 
                                echo '<table id="invisibleTable">';
                                echo '<tr><td id="itd"><strong>'.$lang['ADDRESS'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'address').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="address"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';                            
                                echo '<tr><td id="itd"><strong>'.$lang['COMMUNE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'commune').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="commune"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';                            
                                echo '<tr><td id="itd"><strong>'.$lang['CAP'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'CAP').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="CAP"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['PHONE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'phone').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="phone"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['MOBILE_PHONE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mobile_phone').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="mobile_phone"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['MAIL'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mail').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['REFERENCE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'reference').'"/><input type="hidden" name="table" value="Organization"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="org_id"><input type="hidden" name="key_value" value="'.$org_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><form action="include/eraser.php" name="eraser_form" onsubmit="return disp_confirm()" method="post"><input type="hidden" name="key_value" value="'.$org_id.'"/><input type="hidden" name="key" value="org_id"/><input type="hidden" name="table" value="Organization"/><input type="submit" name="submit" value="'.$lang['DELETE'].'"/></form></td></tr>';
                                echo '</table>';
                                }
                            else
                            {
                                echo '<table id="invisibleTable">';
                                echo '<tr><td id="itd"><strong>'.$lang['ADDRESS'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'address')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['COMMUNE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'commune')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['CAP'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'CAP')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['PHONE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'phone')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['MOBILE_PHONE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'mobile_phone')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['MAIL'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'mail')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['REFERENCE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'reference')."</td></tr>";
                                echo '</table>';
                            }
                            echo '<br />';
                            
                            echo '<h3>'.$lang['LIST_VOLUNTEERING'].'</h3>';
                            // Volunteering search form
                            echo '<form action="list_volunteering.php"  method="post">
                                    <input type="hidden" name="search_type" value="org_id">
                                    <input type="hidden" name="search_value" value="'.$org_id.'">
                                    <input type="submit" name="submit"  value ="'.$lang['TOTAL_VOLUNTEERING'].'" />
                                  </form><br /><br />';
                            // Volunteering search form (DATE FILTER)
                            echo '<form action="list_volunteering.php"  method="post">'
                                    .$lang['START_DATE'].': <input type="text" name="date_start" value="DD-MM-YYYY"> '
                                    .$lang['END_DATE'].': <input type="text" name="date_end" value="DD-MM-YYYY">
                                    <input type="hidden" name="search_type" value="org_id">
                                    <input type="hidden" name="search_value" value="'.$org_id.'">
                                    <input type="submit" name="submit"  value ="'.$lang['DATE_VOLUNTEERING'].'" />
                                 </form><br /><br />';                                             
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
        function disp_confirm()
        {
            var r=confirm("Are you sure?")
            return r;
        }
        </script>
    </body>
</html>
