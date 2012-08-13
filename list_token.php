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
        case 'company':
            $query = "SELECT * FROM Token WHERE company_name LIKE '%$search_value%'";
            break;
        case 'boy':
            $query = "SELECT * FROM Token WHERE boy_surname LIKE '%$search_value%'";
            break;
        case 'company_id':
            $query = "SELECT * FROM Token WHERE company_id = '$search_value'";
            break;
        case 'boy_id':
            $query = "SELECT * FROM Token WHERE boy_id = '$search_value'";
            break;
    }
    if(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." AND token_date BETWEEN '$date_start' AND '$date_end'";
    }
}
else
{
    $query = "SELECT * FROM Token";
    if(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." WHERE token_date BETWEEN '$date_start' AND '$date_end'";
    }
}
$limit = " ORDER BY token_date,boy_surname LIMIT $results_per_page OFFSET $offset"
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
                    echo '<form action="list_token.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> <select name="search_type"> <option value="company">'.$lang['SEARCH_COMPANY_NAME'].'</option><option value="boy">'.$lang['SEARCH_SURNAME'].'</option></select><input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" /></form><br />';
                    echo "<table><th>".$lang['SURNAME']."</th><th>".$lang['POINTS']."</th><th>".$lang['DATE']."</th><th>".$lang['COMPANY']."</th>";
                    if(check('admin'))
                        echo "<th>".$lang['DELETE']."</th>";
                    $results = mysql_query($query.$limit, $conn);
                    for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                        $token_id = mysql_result($results, $i, 'token_id');
                        $points = mysql_result($results, $i, 'points');
                        $surname = mysql_result($results, $i, 'boy_surname');
                        $boy_id = mysql_result($results, $i, 'boy_id');
                        $date = mysql_result($results, $i, 'token_date');
                        $company_name = mysql_result($results, $i, 'company_name');
                        $company_id = mysql_result($results, $i, 'company_id');
                        echo "<tr><td><strong><p><a href=\"view_boy.php?codice_fiscale='$boy_id'\">".$surname."</a></p></strong></td><td align=center><p>".$points."</p></td><td align=center><p>".$date."</p></td><td><p><a href=\"view_company.php?p_iva='$company_id'\">".$company_name."</a></p></td>";
                        if(check('admin'))
                            echo '<td><form action="include/eraser.php" name = "delete" method = "post"><input type="hidden" name="table" value="Token"/><input type="hidden" name="key" value="token_id"/><input type="hidden" name="key_value" value="'.$token_id.'"/><input type="submit" name="submit"  value ="'.$lang['DELETE'].'" /></form></td></tr>';
                        else
                            echo "</tr>";
                    }
                    echo "</table>";
                    //Pagination
                    $results_num = mysql_num_rows(mysql_query($query));
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                    {
                        if(isset($date_start)&&isset($date_end))
                            pagination_search_date($results_per_page, $page, "list_token.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num, $_POST['search_value'], $_POST['search_type']);
                        else
                            pagination_search($results_per_page, $page, "list_token.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    }
                    else
                    {
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
