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
        case 'name':
            $query = "SELECT * FROM Company WHERE name LIKE '%$search_value%'";
            break;
        case 'city':
            $query = "SELECT * FROM Company WHERE city LIKE '%$search_value%'";
            break;
        case 'commune':
            $query = "SELECT * FROM Company WHERE commune LIKE '%$search_value%'";
            break;
    }
}
else
    $query = "SELECT * FROM Company";
$limit = " ORDER BY name LIMIT $results_per_page OFFSET $offset"
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
                    echo '<form action="list_company.php" name = "form" method = "post">';
                    echo ' <input type="text" name="search_value" /> <select name="search_type"> <option value="name">'.$lang['SEARCH_NAME'].'</option>'.'<option value="city">'.$lang['SEARCH_CITY'].'</option>'.'<option value="commune">'.$lang['SEARCH_COMMUNE'].'</option></select><input type="submit" name="submit"  value ="'.$lang['SEARCH'].'" /></form><br /><br />';
                    echo "<table><th><h4>".$lang['NAME']."</h4></th><th><h4>".$lang['CITY']."</h4></th><th><h4>".$lang['COMMUNE']."</h4></th><th><h4>".$lang['TOKENS']."</h4></th><th><h4>".$lang['SALES']."</h4></th>";
                    $results = mysql_query($query.$limit, $conn);
                    for ($i = 0; (($i < $results_per_page) && ($i < mysql_num_rows($results))); $i++) {
                        $name = mysql_result($results, $i, 'name');
                        $commune = mysql_result($results, $i, 'commune');
                        $city = mysql_result($results, $i, 'city');
                        $p_iva = mysql_result($results, $i, 'p_iva');
                        $tokens = mysql_query("SELECT SUM(points) as totalTokens FROM Token WHERE company_id = '$p_iva' GROUP BY company_id", $conn);
                        if(mysql_num_rows($tokens)>0)
                        {
                            $tokens = mysql_result($tokens, 0, 'totalTokens');
                        }
                        else 
                        {    
                            $tokens = 0;
                        }
                        $sales = mysql_query("SELECT SUM(amount) as totalSales FROM Invoice WHERE company_id = '$p_iva' GROUP BY company_id", $conn);
                        if(mysql_num_rows($sales)>0)
                        {
                            $sales = mysql_result($sales, 0, 'totalSales');
                        }
                        else 
                        {    
                            $sales = 0;
                        }
                        echo "<tr><td><a href=\"view_company.php?p_iva=$p_iva\"><strong><p>".$name."</p></strong></a></td><td><p>".$city."</p></td><td><p>".$commune."</p></td><td align=center><p>".$tokens."</p></td><td align=center><p>".$sales."€</p></td>";
                    }
                    echo "</table>";
                    //Pagination
                    $results_num = mysql_num_rows(mysql_query($query));
                    if(isset($_POST['search_value'])&&strlen($_POST['search_value'])>0)
                        pagination_search($results_per_page, $page, "list_company.php?", $results_num, $_POST['search_value'], $_POST['search_type']);
                    else
                        pagination($results_per_page, $page, "list_company.php?", $results_num);
                }
                else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
