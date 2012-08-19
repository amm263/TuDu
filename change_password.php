<!DOCTYPE html>
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
include('include/header.php');
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
                <?php getHeader(); ?>
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
                <table id="invisibleTable"> 
                    <tr><td id="itd"><strong><?php echo $lang['CURRENT_PASSWORD']?></strong></td><td id="itd"> <input type="password" name="current_password" /></td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['NEW_PASSWORD']?></strong></td><td id="itd"> <input type="password" name="new_password" /></td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['REPEAT_PASSWORD']?></strong></td><td id="itd"> <input type="password" name="new_password2" /></td></tr>
                </table>
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
