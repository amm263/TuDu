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
        <title><?php echo $lang['NEW_BOY']; ?></title>
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
                <form action="include/insert_boy.php" name = "form" onsubmit="return validateForm()" method = "post">
    		<table id="invisibleTable">
                    <tr><td id="itd"><strong><?php echo $lang['NAME'] ?></strong></td><td id="itd"> <input type="text" name="name" />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['SURNAME'] ?></strong></td><td id="itd"> <input type="text" name="surname" />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['ADDRESS'] ?></strong></td><td id="itd"> <input type="text" name="address" />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['COMMUNE'] ?></strong></td><td id="itd"> <input type="text" name="commune" />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['CAP'] ?> </strong></td><td id="itd"><input type="text" name="CAP" />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['DATE_OF_BIRTH'] ?></strong></td><td id="itd">
                                                            <select name="day">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="30">30</option>
                                                                <option value="31">31</option>
                                                            </select>
                                                            <select name="month">
                                                                <option value=1><?php echo $lang['JANUARY']; ?></option>
                                                                <option value=2><?php echo $lang['FEBRUARY']; ?></option>
                                                                <option value=3><?php echo $lang['MARCH']; ?></option>
                                                                <option value=4><?php echo $lang['APRIL']; ?></option>
                                                                <option value=5><?php echo $lang['MAY']; ?></option>
                                                                <option value=6><?php echo $lang['JUNE']; ?></option>
                                                                <option value=7><?php echo $lang['JULY']; ?></option>
                                                                <option value=8><?php echo $lang['AUGUST']; ?></option>
                                                                <option value=9><?php echo $lang['SEPTEMBER']; ?></option>
                                                                <option value=10><?php echo $lang['OCTOBER']; ?></option>
                                                                <option value=11><?php echo $lang['NOVEMBER']; ?></option>
                                                                <option value=12><?php echo $lang['DECEMBER']; ?></option>
                                                        </select>
                                                    <input type="text" size="4" name="year" value="YYYY"><br />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['PHONE'] ?></strong></td><td id="itd"> <input type="text" name="phone" /></td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['MOBILE_PHONE'] ?></strong></td><td id="itd"> <input type="text" name="mobile_phone" />*</td></tr>
                    <tr><td id="itd"><strong><?php echo $lang['MAIL'] ?></strong></td><td id="itd"> <input type="text" name="mail" />*</td></tr>
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

            var p = document.forms['form']['surname'].value;
            if(p == null || p == ""){
                    alert ("Surname can not be empty!");
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
            
            var u = document.forms['form']['mobile_phone'].value;
            if(u == null || u == ""){
                    alert ("Mobile Phone can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['commune'].value;
            if(u == null || u == ""){
                    alert ("Commune can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['year'].value;
            if(u == null || u == "" || u=="YYYY"){
                    alert ("Date of birth can not be empty!");
                    return false;
            }
            
            var u = document.forms['form']['mail'].value;
            if(u == null || u == ""){
                    alert ("Mail can not be empty!");
                    return false;
            }
        }
        </script>
    </body>
</html>
