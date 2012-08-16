<?php
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
        echo '<p>'.$lang['WELCOME'].' <strong>'.$_SESSION['user'].'</strong></p></ br>';
        echo '<p>Locale: '.$_SESSION['locale'].'</ br></p>';
    }
    switch($privilege)
    {
        case 'none':
            echo "<p>".$lang['NO_LOGIN']."</p>";
            echo "<p><a href=\"login.php\"/> Login</a></p>";
            break;
        case 'admin':
            echo "<strong><p>".$lang['ADMINISTRATION']."</strong></p>";
            echo "<p><a href=\"new_user.php\"/> ".$lang['NEW_USER']."</a></p>";
            echo "<p><a href=\"new_boy.php\"/> ".$lang['NEW_BOY']."</a></p>";
            echo "<p><a href=\"new_organization.php\"/> ".$lang['NEW_ORGANIZATION']."</a></p>";
            echo "<p><a href=\"new_company.php\"/> ".$lang['NEW_COMPANY']."</a></p>";
        case 'manager':
            echo "<strong><p>".$lang['MANAGEMENT']."</strong></p>";
            echo "<p><a href=\"list_boy.php\"/> ".$lang['LIST_BOY']."</a></p>";
            echo "<p><a href=\"list_organization.php\"/> ".$lang['LIST_ORGANIZATION']."</a></p>";
            echo "<p><a href=\"list_company.php\"/> ".$lang['LIST_COMPANY']."</a></p>";
            echo "<p><a href=\"list_item.php\"/> ".$lang['LIST_ITEM']."</a></p>";
            echo "<p><a href=\"list_invoice.php\"/> ".$lang['LIST_INVOICE']."</a></p>";
            echo "<p><a href=\"list_token.php\"/> ".$lang['LIST_TOKEN']."</a></p>";
            echo "<p><a href=\"list_volunteering.php\"/> ".$lang['LIST_VOLUNTEERING']."</a></p>";
            echo "<strong><p>Account</p></strong>";
            echo "<p><a href=\"login.php\"/> Login</a></p>";
            echo "<p><a href=\"change_password.php\"/>".$lang['PASSWORD_CHANGE']."</a></p>";
            break;
    }
}
?>
