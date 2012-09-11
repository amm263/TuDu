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
 *  file: date_format_change.php
 * 
 *  In order to not change the date format on MySQL (it's not well supported), i prefer to change the date format in the code from DD-MM-YYYY (preferred by the client) to YYYY-MM-DD (MySQL)
 * 
 */
function changeDate($date)
{
    $subdate = explode("-", $date);
    return $subdate[2]."-".$subdate[1]."-".$subdate[0];
}
?>
