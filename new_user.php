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
                if(check('admin'))
                {?>
                <form action="include/insert_user.php" name = "form" onsubmit="return validateForm()" method = "post">
                <table id="invisibleTable">    
                    <tr><td id="itd"><strong>User</strong></td><td id="itd"> <input type="text" name="user" /></td></tr>
                    <tr><td id="itd"><strong>Password</strong></td><td id="itd"> <input type="password" name="password" /></td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['PRIVILEGE'] ?></strong></td><td id="itd"> <select name="privilege">
                        <option value="admin"> <?php echo $lang['ADMINISTRATOR'] ?> </option>
                        <option value="manager"> <?php echo $lang['MANAGER'] ?> </option> 
                    </select> </td></tr>
                </table>
    		<input type="submit" name="submit"  value ="Submit" /></form>
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
