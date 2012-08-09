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
            echo "<strong><p>Account</p></strong>";
            echo "<p><a href=\"login.php\"/> Login</a></p>";
            echo "<p><a href=\"new_user.php\"/> ".$lang['NEW_USER']."</a></p>";
            echo "<p><a href=\"new_boy.php\"/> ".$lang['NEW_BOY']."</a></p>";
            echo "<p><a href=\"new_organization.php\"/> ".$lang['NEW_ORGANIZATION']."</a></p>";
        case 'manager':
            echo "<strong><p>".$lang['MANAGEMENT']."</strong></p>";
            echo "<p><a href=\"list_boy.php\"/> ".$lang['LIST_BOY']."</a></p>";
            break;
    }
}
?>
