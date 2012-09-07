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
        <title><?php echo $lang['NEW_COMPANY']; ?></title>
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
                <form action="include/insert_company.php" name = "form" onsubmit="return validateForm()" method = "post">
                <table id="invisibleTable">    
                     <tr><td id="itd"><strong><?php echo $lang['NAME'] ?></strong></td><td id="itd"> <input type="text" name="name" />*</td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['ADDRESS'] ?></strong></td><td id="itd"> <input type="text" name="address" />*</td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['COMMUNE'] ?></strong></td><td id="itd"> <input type="text" name="commune" />*</td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['CAP'] ?></strong></td><td id="itd"> <input type="text" name="CAP" />*</td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['PHONE'] ?></strong></td><td id="itd"> <input type="text" name="phone" /></td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['MOBILE_PHONE'] ?></strong></td><td id="itd"> <input type="text" name="mobile_phone" /></td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['MAIL'] ?></strong></td><td id="itd"> <input type="text" name="mail" /></td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['REFERENCE'] ?></strong></td><td id="itd"> <input type="text" name="reference" /></td></tr>
                     <tr><td id="itd"><strong><?php echo $lang['P_IVA'] ?></strong></td><td id="itd"> <input type="text" name="P_IVA" /></td></tr>
                </table>
                <?php echo $lang['OBLIGATORY'] ?><br />
    		<input type="submit" name="submit"  value ="Submit" /></form>
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
            
            var u = document.forms['form']['commune'].value;
            if(u == null || u == ""){
                    alert ("Commune can not be empty!");
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
