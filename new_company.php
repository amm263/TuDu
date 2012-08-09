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
                <form action="include/insert_company.php" name = "form" onsubmit="return validateForm()" method = "post">
    		<?php echo $lang['NAME'] ?>: <input type="text" name="name" />*<br />
                <?php echo $lang['ADDRESS'] ?> <input type="text" name="address" />*<br />
                <?php echo $lang['CAP'] ?> <input type="text" name="CAP" />*<br />
                <?php echo $lang['CITY'] ?> <input type="text" name="city" />*<br />
                <?php echo $lang['PHONE'] ?> <input type="text" name="phone" /><br />
                <?php echo $lang['MOBILE_PHONE'] ?> <input type="text" name="mobile_phone" /><br />
                <?php echo $lang['MAIL'] ?> <input type="text" name="mail" /><br />
                <?php echo $lang['REFERENCE'] ?> <input type="text" name="reference" /><br />
                <?php echo $lang['P_IVA'] ?> <input type="text" name="P_IVA" /><br />
                <?php echo $lang['OBLIGATORY'] ?><br />
    		<input type="submit" name="submit"  value ="Submit" />
                <?php }
                    else
                    echo $lang['NO_PRIVILEGE'];
                ?>
            </div>
        </div>
        <script type="text/javascript">
        function validateForm(){
            var u = document.forms['form']['name'].value;
            if(u == null || u == ""){
                    alert ("Name can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['address'].value;
            if(u == null || u == ""){
                    alert ("Address can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['CAP'].value;
            if(u == null || u == ""){
                    alert ("CAP can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['city'].value;
            if(u == null || u == ""){
                    alert ("City can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['P_IVA'].value;
            if(u == null || u == ""){
                    alert ("City can not be empty!");
                    return false;
            }
            
        }
        </script>
    </body>
</html>
