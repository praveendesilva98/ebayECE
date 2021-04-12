<?php

$email_admin = $_SESSION['login'];

if(logged_in())
{
    redirect("logout.php");
}
else
{
    if(logged_in_admin())
    {        
        $sql = "SELECT * FROM admin WHERE login ='$email_admin'";
        $result = query($sql);
        $user = fetch_array($result);
    }
    else
    {
        redirect("adminLogout.php");
    }
}




    

?>