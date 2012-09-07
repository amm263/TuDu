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
 *  file: mailing_list_creator.php
 * 
 *  Creates a long string with Boys mails for mailing list purpose.
 *  Format: mail@example.com,othermail@example.com,mailwhatever@example2.com,.....
 * 
 */
include ('connect.php');
if (isset($_POST['query']))
{
    $query = $_POST['query'];
    $results = mysql_query($query);
    for ($i = 0; $i < mysql_num_rows($results); $i++)
    {
        echo mysql_result($results, $i, 'mail').",";
    }
}
else
{
    echo "Nothing to see here";
    echo ('<meta http-equiv="refresh" content="1; url=../index.php">');
}
?>
