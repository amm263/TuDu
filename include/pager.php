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
function pagination($results_per_page, $current_page, $page, $results_num)
{
$pages_total= ceil($results_num/$results_per_page);

$first="<a href=\"".$page."page=0\">First</a> ";
$prev=" <a href=\"".$page."page=".strval($current_page-1)."\">Previous</a> ";
$mid=" <a href=\"".$page."page=".$current_page."\">Page ".strval($current_page+1)." of ".$pages_total."</a> ";
$next=" <a href=\"".$page."page=".strval($current_page+1)."\">Next</a> ";
$last=" <a href=\"".$page."page=".strval($pages_total-1)."\">Last</a>";

//If ther is only one page
if($pages_total==1)
    echo "<div id=\"Pagin\">\n".$mid."</div>";
//If the number of the next page is bigger than the total pages, don't show the link Next 
else if ($current_page+1>$pages_total-1)
    echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$last."</div>";
//If this is the initial page, there are no Previous
else if ($current_page==0)
    echo "<div id=\"Pagin\">\n".$first.$mid.$next.$last."</div>";
else
    echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$next.$last."</div>";
}

/*  
 * NOTE: Pagination search is used when there is an active search filter on the requesting page 
 */
function pagination_search($results_per_page, $current_page, $page, $results_num, $search_value, $search_type)
{
    $pages_total= ceil($results_num/$results_per_page);

    $first="<a href=\"".$page."page=0&search_type=".$search_type."&search_value=".$search_value."\">First</a> ";
    $prev=" <a href=\"".$page."page=".strval($current_page-1)."&search_type=".$search_type."&search_value=".$search_value."\">Previous</a> ";
    $mid=" <a href=\"".$page."page=".$current_page."&search_type=".$search_type."&search_value=".$search_value."\">Page ".strval($current_page+1)." of ".$pages_total."</a> ";
    $next=" <a href=\"".$page."page=".strval($current_page+1)."&search_type=".$search_type."&search_value=".$search_value."\">Next</a> ";
    $last=" <a href=\"".$page."page=".strval($pages_total-1)."&search_type=".$search_type."&search_value=".$search_value."\">Last</a>";

    
    if($pages_total==1)
        echo "<div id=\"Pagin\">\n".$mid."</div>";
    else if ($current_page+1>$pages_total-1)
        echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$last."</div>";
    else if ($current_page==0)
        echo "<div id=\"Pagin\">\n".$first.$mid.$next.$last."</div>";
    else
        echo "<div id=\"Pagin\">\n".$first.$prev.$mid.$next.$last."</div>";
}
?>

