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

if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
{
    $search_value = $_POST['search_value'];
    switch($_POST['search_type'])
    {
        case 'company':
            $query = "SELECT * FROM Invoice WHERE company_name LIKE '%$search_value%'";
            break;
        case 'company_id':
            $query = "SELECT * FROM Invoice WHERE company_id = '$search_value'";
            break;
    }
    if(isset($_POST['date_start'])&&isset($_POST['date_end']))
    {
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $query = $query." AND inv_date BETWEEN '$date_start' AND '$date_end'";
    }
    elseif(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." AND inv_date BETWEEN '$date_start' AND '$date_end'";
    }
}
else
{
    $query = "SELECT * FROM Invoice";
    if(isset($_POST['date_start'])&&isset($_POST['date_end']))
    {
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $query = $query." WHERE inv_date BETWEEN '$date_start' AND '$date_end'";
    }
    elseif(isset($_GET['date_start'])&&isset($_GET['date_end']))
    {
        $date_start = $_GET['date_start'];
        $date_end = $_GET['date_end'];
        $query = $query." WHERE inv_date BETWEEN '$date_start' AND '$date_end'";
    }
}
$limit = " ORDER BY inv_date DESC LIMIT $results_per_page OFFSET $offset"
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
                <?php getHeader(); ?>
            </div>   
            <div id="Navbar">
                <?php getBar(); ?>
            </div>
            <div id="Content">
                 <?php 
                include('include/privilege_check.php');
                if(check('admin')||check('manager'))
                {
                    echo '<form action="list_invoice.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> <select name="search_type"> <option value="company">'.$lang['SEARCH_COMPANY_NAME'].'</option></select><input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" /></form><br /><br />';
                    echo "<table><th><h4>".$lang['COMPANY']."</h4></th><th><h4>".$lang['PRICE']."</h4></th><th><h4>".$lang['DATE']."</h4></th>";
                    if(check('admin'))
                        echo "<th>".$lang['DELETE']."</th>";
                    $results = mysql_query($query.$limit, $conn);
                    if(mysql_num_rows($results)>0)
                    {
                        for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                            $inv_id = mysql_result($results, $i, 'inv_id');
                            $date = mysql_result($results, $i, 'inv_date');
                            $price = mysql_result($results, $i, 'amount');
                            $company_name = mysql_result($results, $i, 'company_name');
                            $company_id = mysql_result($results, $i, 'company_id');
                            echo "<tr><td><strong><p><a href=\"view_company.php?p_iva=$company_id\">".$company_name."</a></p></strong></td><td align=center><p>".$price."€</p></td><td align=center><p>".$date."</p></td>";
                            if(check('admin'))
                                echo '<td><form action="include/eraser.php" name = "delete" method = "post"><input type="hidden" name="table" value="Invoice"/><input type="hidden" name="key" value="inv_id"/><input type="hidden" name="key_value" value="'.$inv_id.'"/><input type="submit" name="submit"  value ="'.$lang['DELETE'].'" /></form></td></tr>';
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
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                    {
                        if(isset($date_start)&&isset($date_end))
                            pagination_search($results_per_page, $page, "list_invoice.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num, $_POST['search_value'], $_POST['search_type']);
                        else
                            pagination_search($results_per_page, $page, "list_invoice.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    }
                    else
                    {
                        if(isset($date_start)&&isset($date_end))
                            pagination($results_per_page, $page, "list_invoice.php?date_start=".$date_start."&date_end=".$date_end."&", $results_num);
                        else
                            pagination($results_per_page, $page, "list_invoice.php?", $results_num);
                    }
                }
                else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
