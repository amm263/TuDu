<?php
function check($privilege)
{
    if(isset($_SESSION))
    {
        if (isset($_SESSION['privilege']))
        {
            if ($_SESSION['privilege']==$privilege)
            {
                return true;
            }
        }
    } 
    return false;
}
?>
