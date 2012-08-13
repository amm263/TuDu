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
        case 'organization':
            $query = "SELECT * FROM Volunteering WHERE organization_name LIKE '%$search_value%'";
            break;
        case 'boy':
            $query = "SELECT * FROM Volunteering WHERE boy_surname LIKE '%$search_value%'";
            break;
        case 'organization_id':
            $query = "SELECT * FROM Volunteering WHERE organization_id = '$search_value'";
            break;
        case 'boy_id':
            $query = "SELECT * FROM Token WHERE boy_id = '$search_value'";
            break;
    }
    if(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." AND vol_date BETWEEN '$date_start' AND '$date_end'";
    }
}
else
{
    $query = "SELECT * FROM Volunteering";
    if(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." WHERE vol_date BETWEEN '$date_start' AND '$date_end'";
    }
}
$limit = " ORDER BY vol_date,boy_surname LIMIT $results_per_page OFFSET $offset"
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
                    echo '<form action="list_volunteering.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> <select name="search_type"> <option value="organization">'.$lang['SEARCH_ORGANIZATION_NAME'].'</option><option value="boy">'.$lang['SEARCH_SURNAME'].'</option></select><input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" /></form><br />';
                    echo "<table><th>".$lang['SURNAME']."</th><th>".$lang['POINTS']."</th><th>".$lang['DATE']."</th><th>".$lang['ORGANIZATION']."</th>";
                    if(check('admin'))
                        echo "<th>".$lang['DELETE']."</th>";
                    $results = mysql_query($query.$limit, $conn);
                    for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                        $vol_id = mysql_result($results, $i, 'vol_id');
                        $points = mysql_result($results, $i, 'points');
                        $surname = mysql_result($results, $i, 'boy_surname');
                        $boy_id = mysql_result($results, $i, 'boy_id');
                        $date = mysql_result($results, $i, 'vol_date');
                        $organization_name = mysql_result($results, $i, 'organization_name');
                        $organization_id = mysql_result($results, $i, 'organization_id');
                        echo "<tr><td><strong><p><a href=\"view_boy.php?codice_fiscale='$boy_id'\">".$surname."</a></p></strong></td><td align=center><p>".$points."</p></td><td align=center><p>".$date."</p></td><td><p><a href=\"view_organization.php?org_id='$organization_id'\">".$organization_name."</a></p></td>";
                        if(check('admin'))
                            echo '<td><form action="include/eraser.php" name = "delete" method = "post"><input type="hidden" name="table" value="Volunteering"/><input type="hidden" name="key" value="vol_id"/><input type="hidden" name="key_value" value="'.$vol_id.'"/><input type="submit" name="submit"  value ="'.$lang['DELETE'].'" /></form></td></tr>';
                        else
                            echo "</tr>";
                    }
                    echo "</table>";
                    //Pagination
                    $results_num = mysql_num_rows(mysql_query($query));
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                    {
                        if(isset($date_start)&&isset($date_end))
                            pagination_search_date($results_per_page, $page, "list_volunteering.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num, $_POST['search_value'], $_POST['search_type']);
                        else
                            pagination_search($results_per_page, $page, "list_volunteering.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    }
                    else
                    {
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
