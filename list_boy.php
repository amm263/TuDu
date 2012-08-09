<!DOCTYPE html>
<?php
include('include/navbar.php');
include('locale/it.php');
$results_per_page = 20;
// Page offset received?
if(isset($_POST['page']))
    $page = $_POST['page'];
else
    $page = 0;
$offset = $results_per_page*$page;
if(isset($_POST['search_type']))
{
    switch($_POST['search_type'])
    {
        case 'name':
            $search_name = $_POST['search_name'];
            break;
        case 'city':
            $search_city = $_POST['search_city'];
            break;
    }
}
else
    $query = "SELECT * FROM Boy LIMIT $results_per_page OFFSET $offset ";
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
                {?>
                <?php }
                    else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
    </body>
</html>
