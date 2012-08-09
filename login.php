<!DOCTYPE html>
<?php include ('include/navbar.php'); ?>
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
                <form action="include/session.php" name = "formLogin" onsubmit="return validateForm()" method = "post">
    		<input type="text" name="user" />  User <br />
    		<input type="password" name="password" />  Password <br />
    		<input type="submit" name="submit"  value ="Login" />
            </div>
        </div>
        <script type="text/javascript">
        function validateForm(){
            var u = document.forms['formLogin']['user'].value;
            if(u == null || u == ""){
                    alert ("User can not be empty!");
                    return false;
            }

            var p = document.forms['formLogin']['password'].value;
            if(p == null || p == ""){
                    alert ("Password can not be empty!");
                    return false;
            }
        }
        </script>
    </body>
</html>
