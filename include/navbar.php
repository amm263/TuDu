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
function getBar()
{
  include ('locale/it.php');
  if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    //If no one is logged
    if (!isset($_SESSION['privilege']))
        $privilege='none';
    else
        $privilege = $_SESSION['privilege'];
    if(isset($_SESSION['user'])) 
    {
        echo '<h3>'.$lang['WELCOME'].' <strong>'.$_SESSION['user'].'</strong></h3></ br>';
        //echo '<p>Locale: '.$_SESSION['locale'].'</ br></p>';
    }
    switch($privilege)
    {
        case 'none':
            echo "<p>".$lang['NO_LOGIN']."</p>";
            echo "<p><a href=\"login.php\"/> Login</a></p>";
            break;
        case 'admin':
            echo "<h3>".$lang['ADMINISTRATION']."</h3>";
            echo "<p><a href=\"new_user.php\"/> ".$lang['NEW_USER']."</a></p>";
            echo "<p><a href=\"new_boy.php\"/> ".$lang['NEW_BOY']."</a></p>";
            echo "<p><a href=\"new_organization.php\"/> ".$lang['NEW_ORGANIZATION']."</a></p>";
            echo "<p><a href=\"new_company.php\"/> ".$lang['NEW_COMPANY']."</a></p>";
        case 'manager':
            echo "<h3>".$lang['MANAGEMENT']."</h3>";
            echo "<p><a href=\"list_boy.php\"/> ".$lang['LIST_BOY']."</a></p>";
            echo "<p><a href=\"list_organization.php\"/> ".$lang['LIST_ORGANIZATION']."</a></p>";
            echo "<p><a href=\"list_company.php\"/> ".$lang['LIST_COMPANY']."</a></p>";
            echo "<p><a href=\"list_item.php\"/> ".$lang['LIST_ITEM']."</a></p>";
            echo "<p><a href=\"list_invoice.php\"/> ".$lang['LIST_INVOICE']."</a></p>";
            echo "<p><a href=\"list_token.php\"/> ".$lang['LIST_TOKEN']."</a></p>";
            echo "<p><a href=\"list_volunteering.php\"/> ".$lang['LIST_VOLUNTEERING']."</a></p>";
            echo "<h3>Account</h3>";
            echo "<p><a href=\"login.php\"/> Login</a></p>";
            echo "<p><a href=\"change_password.php\"/>".$lang['PASSWORD_CHANGE']."</a></p>";
            break;
    }
}
?>
