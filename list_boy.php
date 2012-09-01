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
 *  file: list_boy.php
 * 
 *  This page provides a list with all the Boys in the database.
 *  It can be applied a filter on the results based on the Surname, City, Commune or CodiceFiscale
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
        case 'surname':
            $query = "SELECT * FROM Boy WHERE surname LIKE '%$search_value%'";
            break;
        case 'city':
            $query = "SELECT * FROM Boy WHERE city LIKE '%$search_value%'";
            break;
        case 'commune':
            $query = "SELECT * FROM Boy WHERE commune LIKE '%$search_value%'";
            break;
        case 'codice_fiscale':
            $query = "SELECT * FROM Boy WHERE codice_fiscale LIKE '%$search_value%'";
            break;
    }
}
// Else go with the standard query
else
    $query = "SELECT * FROM Boy";
$limit = " ORDER BY surname, name LIMIT $results_per_page OFFSET $offset"
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $lang['LIST_BOY']; ?></title>
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
                    // Search Form
                    echo '<form action="list_boy.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> 
                                <select name="search_type"> 
                                    <option value="surname">'.$lang['SEARCH_SURNAME'].'</option>'.
                                    '<option value="city">'.$lang['SEARCH_CITY'].'</option>'.
                                    '<option value="commune">'.$lang['SEARCH_COMMUNE'].'</option>'.
                                    '<option value="codice_fiscale">'.$lang['SEARCH_CODICE_FISCALE'].'</option>
                                </select>
                           <input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" />
                          </form><br /><br />';
                    
                    // Begin of table with Headers
                    echo "<table>
                            <th><h4>".$lang['NAME']." & ".$lang['SURNAME']."</h4></th>
                            <th><h4>".$lang['CITY']."</h4></th>
                            <th><h4>".$lang['COMMUNE']."</h4></th>
                            <th><h4>".$lang['POINTS']."</h4></th><th><h4>".$lang['TOKENS']."</h4></th>
                            <th><h4>".$lang['REMAINING_POINTS']."</h4></th>
                            <th><h4>".$lang['CODICE_FISCALE']."</h4></th>";
                    
                    $results = mysql_query($query.$limit, $conn);
                    for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                        $name = mysql_result($results, $i, 'name');
                        $surname = mysql_result($results, $i, 'surname');
                        $commune = mysql_result($results, $i, 'commune');
                        $city = mysql_result($results, $i, 'city');
                        $codice_fiscale = mysql_result($results, $i, 'codice_fiscale');
                        
                        // Count of the points and tokens of the Boy
                        $points = mysql_query("SELECT SUM(points) as totalPoints FROM Volunteering WHERE boy_id = '$codice_fiscale' GROUP BY boy_id", $conn);
                        if(mysql_num_rows($points)>0)
                        {
                            $points = mysql_result($points, 0, 'totalPoints');
                            $tokens = mysql_query("SELECT SUM(points) as totalPoints FROM Token WHERE boy_id = '$codice_fiscale' GROUP BY boy_id", $conn);
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
                        
                        // Printing the row
                        echo "<tr>
                                <td><a href=\"view_boy.php?codice_fiscale=$codice_fiscale\"><strong><p>".$name." ".$surname."</p></strong></a></td>
                                <td><p>".$city."</p></td><td><p>".$commune."</p></td><td align=center><p>".$points."</p></td><td align=center><p>".$tokens."</p></td>
                                <td align=center><p>".$remaining_points."</p></td>
                                <td><p>".$codice_fiscale."</p></td></tr>";
                    }
                    echo "</table>";
                    //End of Table
                    
                    
                    //Pagination
                    $results_num = mysql_num_rows(mysql_query($query));
                    //If on the page a search filter is active
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                        pagination_search($results_per_page, $page, "list_boy.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    else
                        pagination($results_per_page, $page, "list_boy.php?", $results_num);
                }
                else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
