<!DOCTYPE html>
<?php
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
else
    $query = "SELECT * FROM Boy";
$limit = " ORDER BY surname, name LIMIT $results_per_page OFFSET $offset"
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
                    echo '<form action="list_boy.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> <select name="search_type"> <option value="surname">'.$lang['SEARCH_SURNAME'].'</option>'.'<option value="city">'.$lang['SEARCH_CITY'].'</option>'.'<option value="commune">'.$lang['SEARCH_COMMUNE'].'</option>'.'<option value="codice_fiscale">'.$lang['SEARCH_CODICE_FISCALE'].'</option></select><input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" /></form><br />';
                    echo "<table><th>".$lang['NAME']." & ".$lang['SURNAME']."</th><th>".$lang['CITY']."</th><th>".$lang['COMMUNE']."</th><th>".$lang['POINTS']."</th><th>".$lang['TOKENS']."</th><th>".$lang['REMAINING_POINTS']."</th><th>".$lang['CODICE_FISCALE']."</th>";
                    $results = mysql_query($query.$limit, $conn);
                    for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                        $name = mysql_result($results, $i, 'name');
                        $surname = mysql_result($results, $i, 'surname');
                        $commune = mysql_result($results, $i, 'commune');
                        $city = mysql_result($results, $i, 'city');
                        $codice_fiscale = mysql_result($results, $i, 'codice_fiscale');
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
                        echo "<tr><td><a href=\"view_boy.php?codice_fiscale=$codice_fiscale\"><strong><p>".$name." ".$surname."</p></strong></a></td><td><p>".$city."</p></td><td><p>".$commune."</p></td><td align=center><p>".$points."</p></td><td align=center><p>".$tokens."</p></td><td align=center><p>".$remaining_points."</p></td><td><p>".$codice_fiscale."</p></td></tr>";
                    }
                    echo "</table>";
                    //Pagination
                    $results_num = mysql_num_rows(mysql_query($query));
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
