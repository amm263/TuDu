<?php
function pagination($results_per_page, $current_page, $page, $results_num)
{
$pages_total= ceil($results_num/$results_per_page);

$first="<a href=\"".$page."page=0\">First</a> ";
$prev=" <a href=\"".$page."page=".strval($current_page-1)."\">Previous</a> ";
$mid=" <a href=\"".$page."page=".$current_page."\">Page ".strval($current_page+1)." of ".$pages_total."</a> ";
$next=" <a href=\"".$page."page=".strval($current_page+1)."\">Next</a> ";
$last=" <a href=\"".$page."page=".strval($pages_total-1)."\">Last</a>";

//Se ho una sola pagina, visualizzo solo il link di mezzo.
if($pages_total==1)
    echo "<div id=\"Pagin\">\n".$mid."</div>";
//Se la pagina successiva è maggiore delle pagine totali, non visualizzo il link Successiva.
else if ($current_page+1>$pages_total-1)
    echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$last."</div>";
else if ($current_page==0)
    echo "<div id=\"Pagin\">\n".$first.$mid.$next.$last."</div>";
else
    echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$next.$last."</div>";
}

function pagination_search($results_per_page, $current_page, $page, $results_num, $search_value, $search_type)
{
    $pages_total= ceil($results_num/$results_per_page);

    $first="<a href=\"".$page."page=0&search_type=".$search_type."&search_value=".$search_value."\">First</a> ";
    $prev=" <a href=\"".$page."page=".strval($current_page-1)."&search_type=".$search_type."&search_value=".$search_value."\">Previous</a> ";
    $mid=" <a href=\"".$page."page=".$current_page."&search_type=".$search_type."&search_value=".$search_value."\">Page ".strval($current_page+1)." of ".$pages_total."</a> ";
    $next=" <a href=\"".$page."page=".strval($current_page+1)."&search_type=".$search_type."&search_value=".$search_value."\">Next</a> ";
    $last=" <a href=\"".$page."page=".strval($pages_total-1)."&search_type=".$search_type."&search_value=".$search_value."\">Last</a>";

    //Se ho una sola pagina, visualizzo solo il link di mezzo.
    if($pages_total==1)
        echo "<div id=\"Pagin\">\n".$mid."</div>";
    //Se la pagina successiva è maggiore delle pagine totali, non visualizzo il link Successiva.
    else if ($current_page+1>$pages_total-1)
        echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$last."</div>";
    else if ($current_page==0)
        echo "<div id=\"Pagin\">\n".$first.$mid.$next.$last."</div>";
    else
        echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$next.$last."</div>";
}
?>

