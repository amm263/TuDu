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
                if(check('admin'))
                {?>
                <form action="include/insert_user.php" name = "form" onsubmit="return validateForm()" method = "post">
    		User: <input type="text" name="user" /><br />
    		Password: <input type="password" name="password" /><br />
                <?php echo $lang['PRIVILEGE'] ?>: <select name="privilege">
                    <option value="admin"> <?php echo $lang['ADMINISTRATOR'] ?> </option>
                    <option value="manager"> <?php echo $lang['MANAGER'] ?> </option> 
                </select> <br />
    		<input type="submit" name="submit"  value ="Submit" />
                <?php }
                    else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
        <script type="text/javascript">
        function validateForm(){
            var u = document.forms['form']['user'].value;
            if(u == null || u == ""){
                    alert ("User can not be empty!");
                    return false;
            }

            var p = document.forms['form']['password'].value;
            if(p == null || p == ""){
                    alert ("Password can not be empty!");
                    return false;
            }
        }
        </script>
    </body>
</html>
