<?php include("header.php"); display_message(); 
include("menu.php");

if(!logged_in_admin())
{
    redirect("adminLogin.php");
}
if(logged_in())
{
    redirect("logout.php");
}

$sql = "SELECT * FROM vendeur GROUP BY ID DESC";

affichage_vendeur($con, $sql);

include("footer/footer.php");



?>