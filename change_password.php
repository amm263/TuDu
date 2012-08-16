<!DOCTYPE html>
<?php
include('include/navbar.php');
include('locale/it.php');
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
                <form action="include/password_changer.php" name = "form" onsubmit="return validateForm()" method = "post">
    		Current Password: <input type="password" name="current_password" /><br />
    		New Password: <input type="password" name="new_password" /><br />
                New Password again: <input type="password" name="new_password2" /><br />
                <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
    		<input type="submit" name="submit"  value ="Submit" />
                <?php }
                    else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
        <script type="text/javascript">
        function validateForm(){
            var newpassword = document.forms['form']['new_password'].value;
            var newpassword2 = document.forms['form']['new_password2'].value;
            if(newpassword!=newpassword2){
                    alert ("You entered two new different passwords");
                    return false;
            }

            var p = document.forms['form']['current_password'].value;
            if(p == null || p == ""){
                    alert ("Current Password can not be empty!");
                    return false;
            }
            
            var p = document.forms['form']['new_password'].value;
            if(p == null || p == ""){
                    alert ("New Password can not be empty!");
                    return false;
            }
        }
        </script>
    </body>
</html>
