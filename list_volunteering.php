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
 *  file: list_volunteering.php
 * 
 *  This page provides a list with all the Volunteering hours in the database.
 *  It can be applied a filter on the results based on the Organization Name, Boy Surname, Organization ID, Boy ID, Organization Commune and/or Date.
 * 
 */
include('include/header.php');
include('include/navbar.php');
include('locale/it.php');
include('include/connect.php');
include('include/pager.php');
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
        case 'organization':
            $query = "SELECT * FROM Volunteering WHERE organization_id IN (SELECT DISTINCT org_id FROM Organization WHERE name LIKE '%$search_value%')";
            $points = "SELECT SUM(points) as totalPoints FROM Volunteering WHERE organization_id IN (SELECT DISTINCT org_id FROM Organization WHERE name LIKE '%$search_value%')";
            break;
        case 'boy':
            $query = "SELECT * FROM Volunteering WHERE boy_id IN (SELECT DISTINCT boy_id FROM Boy WHERE surname LIKE '%$search_value%')";
            $points = "SELECT SUM(points) as totalPoints FROM Volunteering WHERE boy_id IN (SELECT DISTINCT boy_id FROM Boy WHERE surname LIKE '%$search_value%')";
            break;
        case 'commune':
            $query = "SELECT * FROM Volunteering WHERE organization_id IN (SELECT DISTINCT org_id FROM Organization WHERE commune LIKE '%$search_value%')";
            $points = "SELECT SUM(points) as totalPoints FROM Volunteering WHERE organization_id IN (SELECT DISTINCT org_id FROM Organization WHERE commune LIKE '%$search_value%')";
            break;
        case 'org_id':
            $query = "SELECT * FROM Volunteering WHERE organization_id = '$search_value'";
            $points = "SELECT SUM(points) as totalPoints FROM Volunteering WHERE organization_id = '$search_value'";
            break;
        case 'boy_id':
            $query = "SELECT * FROM Volunteering WHERE boy_id = '$search_value'";
            $points = "SELECT SUM(points) as totalPoints FROM Volunteering WHERE boy_id = '$search_value'";
            break;
    }
    // If a filter on the Date is requested with the GET or POST method
    if(isset($_POST['date_start'])&&isset($_POST['date_end']))
    {
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $query = $query." AND vol_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." AND vol_date BETWEEN '$date_start' AND '$date_end'";
    }
    elseif(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." AND vol_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." AND vol_date BETWEEN '$date_start' AND '$date_end'";
    }
}
//Else go with the standard query...
else
{
    $query = "SELECT * FROM Volunteering";
    $points = "SELECT SUM(points) as totalPoints FROM Volunteering";
    //..but still apply the Date filter if requested
    if(isset($_POST['date_start'])&&isset($_POST['date_end']))
    {
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $query = $query." WHERE vol_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." WHERE vol_date BETWEEN '$date_start' AND '$date_end'";
    }
    elseif(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." WHERE vol_date BETWEEN '$date_start' AND '$date_end'";
        $points = $points." WHERE vol_date BETWEEN '$date_start' AND '$date_end'";
    }
}
$limit = " ORDER BY vol_date DESC LIMIT $results_per_page OFFSET $offset"
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $lang['LIST_VOLUNTEERING']; ?></title>
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
                    echo '<h4>'.$lang['TOTAL_VOLUNTEERINGS'].': '.$points.'</h4>';
                    
                    //Search form
                    echo '<form action="list_volunteering.php" name = "form" method = "post">';
                    echo '<input type="text" name="search_value" /> 
                            <select name="search_type"> 
                                <option value="organization">'.$lang['SEARCH_ORGANIZATION_NAME'].'</option>
                                <option value="boy">'.$lang['SEARCH_SURNAME'].'</option>
                                <option value="commune">'.$lang['SEARCH_COMMUNE'].'</option>
                            </select>
                           <input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" />
                          </form><br />';
                    
                    // Date filter form
                    echo '<form action="list_volunteering.php" name = "form" method = "post">';
                    echo $lang['START_DATE'].': <input type="text" size="12" name="date_start" value="YYYY-MM-DD"> '.
                         $lang['END_DATE'].': <input type="text" size="12" name="date_end" value="YYYY-MM-DD">';
                    //If a search filter is applied
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                        echo '<input type="hidden" name="search_type" value="'.$_POST['search_type'].'"><input type="hidden" name="search_value" value="'.$_POST['search_value'].'">';
                    echo '<input type="submit" name="submit"  value ="'.$lang['DATE_FILTER'].'" /></form><br /><br />';
                    
                    // Begin of table and Headers
                    echo "<table>
                            <th><h4>".$lang['NAME']." & ".$lang['SURNAME']."</h4></th>
                            <th><h4>".$lang['POINTS']."</h4></th>
                            <th><h4>".$lang['DATE']."</h4></th>
                            <th><h4>".$lang['ORGANIZATION']."</h4></th>";
                    //If the account logged has admin privileges, he can DELETE volunteering
                    if(check('admin'))
                        echo "<th>".$lang['DELETE']."</th>";
                    $results = mysql_query($query.$limit, $conn);
                    if(mysql_num_rows($results)>0)
                    {
                        for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                            $vol_id = mysql_result($results, $i, 'vol_id');
                            $points = mysql_result($results, $i, 'points');
                            $boy_id = mysql_result($results, $i, 'boy_id');
                            $boyResult = mysql_query("SELECT name,surname FROM Boy WHERE boy_id='$boy_id'"); 
                            $name = mysql_result($boyResult, 0, 'name');
                            $surname = mysql_result($boyResult, 0, 'surname');
                            $date = mysql_result($results, $i, 'vol_date');
                            $organization_id = mysql_result($results, $i, 'organization_id');
                            $organization_name = mysql_result(mysql_query("SELECT name FROM Organization WHERE org_id='$organization_id'"), 0, 'name');
                            // Row printing
                            echo "<tr>
                                    <td><strong><p><a href=\"view_boy.php?boy_id=$boy_id\">".$name." ".$surname."</a></p></strong></td>
                                    <td align=center><p>".$points."</p></td>
                                    <td align=center><p>".$date."</p></td>
                                    <td><p><a href=\"view_organization.php?org_id=$organization_id\">".$organization_name."</a></p></td>";
                            //All admins can delete volunteerings hours
                            if(check('admin'))
                                echo '<td>
                                        <form action="include/eraser.php" name = "delete" method = "post">
                                            <input type="hidden" name="table" value="Volunteering"/>
                                            <input type="hidden" name="key" value="vol_id"/>
                                            <input type="hidden" name="key_value" value="'.$vol_id.'"/>
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
                            pagination_search($results_per_page, $page, "list_volunteering.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num, $_POST['search_value'], $_POST['search_type']);
                        else
                            pagination_search($results_per_page, $page, "list_volunteering.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    }
                    else
                    {
                        //If a on the page a date filter is active
                        if(isset($date_start)&&isset($date_end))
                            pagination($results_per_page, $page, "list_volunteering.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num);
                        else
                            pagination($results_per_page, $page, "list_volunteering.php?", $results_num);
                    }
                }
                else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
