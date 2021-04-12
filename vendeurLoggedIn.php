<?php

$pseudo_vendeur = $_SESSION['pseudo_vendeur'];

if(logged_in())
{
    redirect("logout.php");
}
else
{
    if(logged_in_vendeur())
    {        
        $sql = "SELECT * FROM vendeur WHERE Pseudo ='$pseudo_vendeur'";
        $result = query($sql);
        $user = fetch_array($result);
    }
    else
    {
        redirect("vendeurLogout.php");
    }
}




    

?>