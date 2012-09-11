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
 *  file: view_boy.php
 *  
 *  Page showing all the proprieties for a given Boy
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
        <title><?php echo $lang['BOY']; ?></title>
        <script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/ajax-dynamic-list.js">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, April 2006
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	
	</script>
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
                    if(isset($_GET['boy_id']))
                    {
                        $boy_id = $_GET['boy_id'];
                        try{
                        $result = mysql_query("SELECT * FROM Boy WHERE boy_id='$boy_id'",$conn);
                        if(mysql_num_rows($result)==1)
                        {
                            echo "<h1 style=\"text-align: center;\">".mysql_result($result, 0, 'name')." ".mysql_result($result, 0, 'surname')."</h1><br /><br />";
                            // All the admins can modify the properties of the given Boy
                            if(check('admin'))
                            { 
                                echo '<table id="invisibleTable">';
                                echo '<tr><td id="itd"><strong>'.$lang['DATE_OF_BIRTH'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'date_of_birth')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['ADDRESS'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'address').'"/><input type="hidden" name="table" value="Boy"><input type="hidden" name="column" value="address"><input type="hidden" name="key" value="boy_id"><input type="hidden" name="key_value" value="'.$boy_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';                            
                                echo '<tr><td id="itd"><strong>'.$lang['COMMUNE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'commune').'"/><input type="hidden" name="table" value="Boy"><input type="hidden" name="column" value="commune"><input type="hidden" name="key" value="boy_id"><input type="hidden" name="key_value" value="'.$boy_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';                            
                                echo '<tr><td id="itd"><strong>'.$lang['CAP'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'CAP').'"/><input type="hidden" name="table" value="Boy"><input type="hidden" name="column" value="CAP"><input type="hidden" name="key" value="boy_id"><input type="hidden" name="key_value" value="'.$boy_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form><br /></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['PHONE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'phone').'"/><input type="hidden" name="table" value="Boy"><input type="hidden" name="column" value="phone"><input type="hidden" name="key" value="boy_id"><input type="hidden" name="key_value" value="'.$boy_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['MOBILE_PHONE'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mobile_phone').'"/><input type="hidden" name="table" value="Boy"><input type="hidden" name="column" value="mobile_phone"><input type="hidden" name="key" value="boy_id"><input type="hidden" name="key_value" value="'.$boy_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><strong>'.$lang['MAIL'].'</strong></td><td id="itd"><form action="include/updater.php" name = "form" method = "post"><input type="text" name="update" value="'.mysql_result($result, 0, 'mail').'"/><input type="hidden" name="table" value="Boy"><input type="hidden" name="column" value="mail"><input type="hidden" name="key" value="boy_id"><input type="hidden" name="key_value" value="'.$boy_id.'"></td><td id="itd"><input type="submit" name="submit"  value ="'.$lang['UPDATE'].'" /></form></td></tr>';
                                echo '<tr><td id="itd"><form action="include/eraser.php" name="eraser_form" onsubmit="return disp_confirm()" method="post"><input type="hidden" name="key_value" value="'.$boy_id.'"/><input type="hidden" name="key" value="boy_id"/><input type="hidden" name="table" value="Boy"/><input type="submit" name="submit" value="'.$lang['DELETE'].'"/></form></td></tr>';
                                echo '</table>';                                
                                }
                            else
                            {
                                echo '<table id="invisibleTable">';
                                echo '<tr><td id="itd"><strong>'.$lang['DATE_OF_BIRTH'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'date_of_birth')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['ADDRESS'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'address')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['COMMUNE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'commune')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['CAP'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'CAP')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['PHONE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'phone')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['MOBILE_PHONE'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'mobile_phone')."</td></tr>";
                                echo '<tr><td id="itd"><strong>'.$lang['MAIL'].'</strong></td><td id="itd">'.mysql_result($result, 0, 'mail')."</td></tr>";
                                echo '</table>';   
                            }
                            echo '<br />';
                            
                            //Sum of all the points and tokens collected by the Boy                        
                            $points = mysql_query("SELECT SUM(points) as totalPoints FROM Volunteering WHERE boy_id = '$boy_id' GROUP BY boy_id", $conn);
                            if(mysql_num_rows($points)>0)
                            {
                                $points = mysql_result($points, 0, 'totalPoints');
                                $tokens = mysql_query("SELECT SUM(points) as totalPoints FROM Token WHERE boy_id = '$boy_id' GROUP BY boy_id", $conn);
                                if(mysql_num_rows($tokens)>0)
                                {
                                    $tokens = mysql_result($tokens, 0, 'totalPoints');
                                }
                                else
                                {
                                    $tokens = 0;
                                }
                                $remaining_points = $points-$tokens;
                            }
                            else 
                            {    
                                $points = 0;
                                $tokens = 0;
                                $remaining_points = 0;
                            }
                            
                            //Points table
                            echo '<table>';
                            echo '<th><h4>'.$lang['POINTS'].'</h4></th><th><h4>'.$lang['TOKENS'].'</h4></th><th><h4>'.$lang['REMAINING_POINTS'].'</h4></th>';
                            echo '<tr><td align=center><strong>'.$points.'</strong></td><td align=center><strong>'.$tokens.'</strong></td><td align=center><strong>'.$remaining_points.'</strong></td></tr>';
                            echo '</table>'; 
                            echo '<br />';
                            
                           
                            echo '<h3>'.$lang['LIST_VOLUNTEERING'].'</h3>';
                            // Volunteering search form 
                            echo '<form action="list_volunteering.php" method="post">
                                    <input type="hidden" name="search_type" value="boy_id">
                                    <input type="hidden" name="search_value" value="'.$boy_id.'">
                                    <input type="submit" name="submit"  value ="'.$lang['TOTAL_VOLUNTEERING'].'" />
                                  </form><br /><br />';
                            // Volunteering search form (DATE filter)
                            echo '<form action="list_volunteering.php" method="post">'
                                    .$lang['START_DATE'].': <input type="text" size="12" name="date_start" value="DD-MM-YYYY"> '
                                    .$lang['END_DATE'].': <input type="text" size="12" name="date_end" value="DD-MM-YYYY">
                                    <input type="hidden" name="search_type" value="boy_id">
                                    <input type="hidden" name="search_value" value="'.$boy_id.'">
                                    <input type="submit" name="submit"  value ="'.$lang['DATE_VOLUNTEERING'].'" />
                                  </form><br /><br />';
                            
                            echo '<h3>'.$lang['LIST_TOKEN'].'</h3>';
                            // Token search form
                            echo '<form action="list_token.php"  method="post">
                                    <input type="hidden" name="search_type" value="boy_id">
                                    <input type="hidden" name="search_value" value="'.$boy_id.'">
                                    <input type="submit" name="submit"  value ="'.$lang['TOTAL_TOKEN'].'" />
                                  </form><br /><br />';
                            // Token search form (DATE filter)
                            echo '<form action="list_token.php"  method="post">'
                                    .$lang['START_DATE'].': <input type="text" size="12" name="date_start" value="DD-MM-YYYY"> '
                                    .$lang['END_DATE'].': <input type="text" size="12" name="date_end" value="DD-MM-YYYY">
                                    <input type="hidden" name="search_type" value="boy_id">
                                    <input type="hidden" name="search_value" value="'.$boy_id.'">
                                    <input type="submit" name="submit"  value ="'.$lang['DATE_TOKEN'].'" />
                                  </form><br /><br />';
                            
                            // Insert of a new Volunteering row (Uses Ajax-list to fill the organization and the organization_hidden boxes)
                            echo '<h3>'.$lang['NEW_VOLUNTEERING_TITLE'].'</h3>';
                            echo '<form action="include/insert_volunteering.php" name = "vol_form" method="post" onsubmit="return validateVolunteering()">'
                                    .$lang['ORGANIZATION'].': <input type="text" size="40" id="organization" name="organization" value="" onkeyup="ajax_showOptions(this,\'getOrganizationsByLetters\',event)"><br />
                                    <input type="hidden" id="organization_hidden" name="organization_id">
                                    <input type="hidden" name="boy_id" value="'.$boy_id.'">'
                                    .$lang['POINTS'].': <input type="text" name="points"><br />'
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
                                                            <option value=2>'.$lang['FEBRUARY'].'</option>
                                                            <option value=3>'.$lang['MARCH'].'</option>
                                                            <option value=4>'.$lang['APRIL'].'</option>
                                                            <option value=5>'.$lang['MAY'].'</option>
                                                            <option value=6>'.$lang['JUNE'].'</option>
                                                            <option value=7>'.$lang['JULY'].'</option>
                                                            <option value=8>'.$lang['AUGUST'].'</option>
                                                            <option value=9>'.$lang['SEPTEMBER'].'</option>
                                                            <option value=10>'.$lang['OCTOBER'].'</option>
                                                            <option value=11>'.$lang['NOVEMBER'].'</option>
                                                            <option value=12>'.$lang['DECEMBER'].'</option>
                                                    </select>
                                                    <input type="text" size="4" name="year" value="YYYY"><br />'.
                                 '<input type="submit" name="submit"  value ="'.$lang['NEW_VOLUNTEERING'].'" /></form><br />';
                            
                            // Insert of a new Token row (Uses Ajax-list to fill the company and the company_hidden boxes)
                            echo '<h3>'.$lang['NEW_TOKEN_TITLE'].'</h3>';
                            echo '<form action="include/insert_token.php" name = "token_form" method="post" onsubmit="return validateTok()">'
                                    .$lang['COMPANY'].': <input type="text" size="40" id="company" name="company" value="" onkeyup="ajax_showOptions(this,\'getCompaniesByLetters\',event)"><br />
                                    <input type="hidden" id="company_hidden" name="company_id"> 
                                    <input type="hidden" name="boy_id" value="'.$boy_id.'">'
                                    .$lang['POINTS'].': <input type="text" name="points"><br />'
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
                                                            <option value=2>'.$lang['FEBRUARY'].'</option>
                                                            <option value=3>'.$lang['MARCH'].'</option>
                                                            <option value=4>'.$lang['APRIL'].'</option>
                                                            <option value=5>'.$lang['MAY'].'</option>
                                                            <option value=6>'.$lang['JUNE'].'</option>
                                                            <option value=7>'.$lang['JULY'].'</option>
                                                            <option value=8>'.$lang['AUGUST'].'</option>
                                                            <option value=9>'.$lang['SEPTEMBER'].'</option>
                                                            <option value=10>'.$lang['OCTOBER'].'</option>
                                                            <option value=11>'.$lang['NOVEMBER'].'</option>
                                                            <option value=12>'.$lang['DECEMBER'].'</option>
                                                    </select>
                                                    <input type="text" size="4" name="year" value="YYYY"><br />'.
                                 '<input type="submit" name="submit"  value ="'.$lang['NEW_TOKEN'].'" /></form><br /><br />';
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
        function validateVolunteering(){
            var u = document.forms['vol_form']['organization'].value;
            if(u == null || u == ""){
                    alert ("Organization can not be empty!");
                    return false;
            }

            var p = document.forms['vol_form']['points'].value;
            if(p == null || p == ""){
                    alert ("Points can not be empty!");
                    return false;
            }
            
            var u = document.forms['vol_form']['year'].value;
            if(u == null || u == "" || isNaN(u) || u>3000 || u<1900 ){
                    alert ("Year not valid!");
                    return false;
            }
        }
        
        function disp_confirm()
        {
        var r=confirm("Are you sure?")
        return r;
        }
        
        function validateTok(){
            var u = document.forms['token_form']['company'].value;
            if(u == null || u == ""){
                    alert ("Company can not be empty!");
                    return false;
            }

            var p = document.forms['token_form']['points'].value;
            if(p == null || p == ""){
                    alert ("Points can not be empty!");
                    return false;
            }
            
            var u = document.forms['token_form']['year'].value;
            if(u == null || u == "" || isNaN(u) || u>3000 || u<1900 ){
                    alert ("Year not valid!");
                    return false;
            }
        }
        </script>
    </body>
</html>
