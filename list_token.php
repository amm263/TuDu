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
 *  file: list_token.php
 * 
 *  This page provides a list with all the Tokens in the database.
 *  It can be applied a filter on the results based on the Company Name, Boy Surname, Company ID, Boy ID or/and Date
 * 
 */
include('include/header.php');
include('include/navbar.php');
include('locale/it.php');
include('include/connect.php');
include('include/pager.php');
include('include/date_format_change.php');
$results_per_page = 20;
// Page offset received?
if(isset($_GET['page']))
{
    $page = $_GET['page'];
    if(isset($_GET['search_value'])&&isset($_GET['search_type']))
    {
        $_POST['search_value']= $_GET['search_value'];
        $_POST['search_type']= $_GET['search_type'];
    }
}
else
    $page = 0;

$offset = $results_per_page*$page;

// If a search is performed on the page
if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
{
    $search_value = $_POST['search_value'];
    switch($_POST['search_type'])
    {
        case 'company':
            $query = "SELECT * FROM Token WHERE company_id IN (SELECT DISTINCT p_iva FROM Company WHERE name LIKE '%$search_value%')";
            $points = "SELECT SUM(points) as totalPoints FROM Token WHERE company_id IN (SELECT DISTINCT p_iva FROM Company WHERE name LIKE '%$search_value%')";
            break;
        case 'boy':
            $query = "SELECT * FROM Token WHERE boy_id IN (SELECT DISTINCT boy_id FROM Boy where surname LIKE '%$search_value%')";
            $points = "SELECT SUM(points) as totalPoints FROM Token WHERE boy_id IN (SELECT DISTINCT boy_id FROM Boy where surname LIKE '%$search_value%')";
            break;
        case 'company_id':
            $query = "SELECT * FROM Token WHERE company_id = '$search_value'";
            $points = "SELECT SUM(points) as totalPoints FROM Token WHERE company_id = '$search_value'";
            break;
        case 'boy_id':
            $query = "SELECT * FROM Token WHERE boy_id = '$search_value'";
            $points = "SELECT SUM(points) as totalPoints FROM Token WHERE boy_id = '$search_value'";
            break;
    }
    // If a filter on the Date is requested with the GET or POST method
    if(isset($_POST['date_start'])&&isset($_POST['date_end']))
    {
        $date_start = changeDate($_POST['date_start']);
        $date_end = changeDate($_POST['date_end']);
        $query = $query." AND token_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." AND token_date BETWEEN '$date_start' AND '$date_end'";
    }
    elseif(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = changeDate($_GET['date_start']);
        $date_end = changeDate($_GET['date_end']);
        $query = $query." AND token_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." AND token_date BETWEEN '$date_start' AND '$date_end'";
    }
}
//Else go with the standard query...
else
{
    $query = "SELECT * FROM Token";
    $points = "SELECT SUM(points) as totalPoints FROM Token";
    //..but still apply the Date filter if requested
    if(isset($_POST['date_start'])&&isset($_POST['date_end']))
    {
        $date_start = changeDate($_POST['date_start']);
        $date_end = changeDate($_POST['date_end']);
        $query = $query." WHERE token_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." AND token_date BETWEEN '$date_start' AND '$date_end'";
    }
    elseif(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = changeDate($_GET['date_start']);
        $date_end = changeDate($_GET['date_end']);
        $query = $query." WHERE token_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." AND token_date BETWEEN '$date_start' AND '$date_end'";
    }
}
$limit = " ORDER BY token_date DESC LIMIT $results_per_page OFFSET $offset"
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $lang['LIST_TOKEN']; ?></title>
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
                    //Sum of the points in the list (even with filters applied)
                    $points = mysql_query($points, $conn);
                    if(mysql_num_rows($points)>0)
                    {
                        $points = mysql_result($points, 0, 'totalPoints');
                    }
                    else 
                    {    
                        $points = 0;
                    }
                    echo '<h4>'.$lang['TOTAL_TOKENS'].': '.$points.'</h4>';
                    
                    //Search form
                    echo '<form action="list_token.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> 
                                <select name="search_type"> 
                                    <option value="company">'.$lang['SEARCH_COMPANY_NAME'].'</option>
                                    <option value="boy">'.$lang['SEARCH_SURNAME'].'</option>
                                </select>
                           <input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" />
                          </form><br /><br />';
                    
                    //Begin of table and Headers
                    echo "<table>
                            <th><h4>".$lang['NAME']." & ".$lang['SURNAME']."</h4></th>
                            <th><h4>".$lang['POINTS']."</h4></th>
                            <th><h4>".$lang['DATE']."</th>
                            <th><h4>".$lang['COMPANY']."</h4></th>";
                    //If the account logged has admin privileges, he can DELETE tokens
                    if(check('admin'))
                        echo "<th>".$lang['DELETE']."</th>";
                    
                    $results = mysql_query($query.$limit, $conn);
                    if(mysql_num_rows($results)>0)
                    {
                        for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                            $token_id = mysql_result($results, $i, 'token_id');
                            $points = mysql_result($results, $i, 'points');
                            $boy_id = mysql_result($results, $i, 'boy_id');
                            $boyResult = mysql_query("SELECT name,surname FROM Boy WHERE boy_id='$boy_id'"); 
                            $name = mysql_result($boyResult, 0, 'name');
                            $surname = mysql_result($boyResult, 0, 'surname');
                            $date = mysql_result($results, $i, 'token_date');
                            $company_id = mysql_result($results, $i, 'company_id');
                            $company_name = mysql_result(mysql_query("SELECT name FROM Company WHERE p_iva='$company_id'"), 0, 'name');
                            //Row print
                            echo "<tr>
                                    <td><strong><p><a href=\"view_boy.php?boy_id=$boy_id\">".$name." ".$surname."</a></p></strong></td>
                                    <td align=center><p>".$points."</p></td>
                                    <td align=center><p>".$date."</p></td>
                                    <td><p><a href=\"view_company.php?p_iva=$company_id\">".$company_name."</a></p></td>";
                            //All admins can delete tokens
                            if(check('admin'))
                                echo '<td>
                                        <form action="include/eraser.php" name = "delete" method = "post">
                                            <input type="hidden" name="table" value="Token"/>
                                            <input type="hidden" name="key" value="token_id"/>
                                            <input type="hidden" name="key_value" value="'.$token_id.'"/>
                                            <input type="submit" name="submit"  value ="'.$lang['DELETE'].'" />
                                        </form>
                                      </td></tr>';
                            else
                                echo "</tr>";
                        }
                    }
                    else {
                        echo $lang['NO_RESULTS'];
                    }
                    echo "</table>";
                    //Pagination
                    $results_num = mysql_num_rows(mysql_query($query));
                    //If on the page a search filter is active
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                    {
                        //If a on the page a date filter is active
                        if(isset($date_start)&&isset($date_end))
                            pagination_search($results_per_page, $page, "list_token.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num, $_POST['search_value'], $_POST['search_type']);
                        else
                            pagination_search($results_per_page, $page, "list_token.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    }
                    else
                    {
                        //If a on the page a date filter is active
                        if(isset($date_start)&&isset($date_end))
                            pagination($results_per_page, $page, "list_token.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num);
                        else
                            pagination($results_per_page, $page, "list_token.php?", $results_num);
                    }
                }
                else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
