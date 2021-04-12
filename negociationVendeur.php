<?php include("header.php"); display_message(); 
include("menu.php");

if(!logged_in_vendeur())
{
    redirect("vendeurLogin.php");
}
if(logged_in())
{
    redirect("logout.php");
}
if(logged_in_admin())
{
    redirect("adminLogout.php");
}

echo "<h4>&nbsp&nbsp&nbsp Des Items aux Meilleures Offres</h4><br><br>";

$pseudo = $_SESSION['Pseudo'];

$sql = mysqli_query($con, "SELECT * FROM vendeur WHERE Pseudo='$pseudo'");
$row = mysqli_fetch_array($sql);

$email = $row['Mail'];

$sql1 = "SELECT * FROM item WHERE vendeur_mail='$email'";

negocier_item($con, $sql1);


include("footer/footer.php"); ?>