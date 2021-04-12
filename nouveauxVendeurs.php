<?php include("header.php"); display_message(); 
include("menu.php");

if(!logged_in_admin())
{
    redirect("adminLogin.php");
}
if(logged_in())
{
    redirect("logout.php");
    redirect("adminLogin.php");
}

$sql = "SELECT * FROM vendeur WHERE Active='0'";
affichage_vendeur($con, $sql);


include("footer/footer.php");



?>