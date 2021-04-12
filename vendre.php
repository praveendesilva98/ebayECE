<?php include("header.php");
display_message();
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

echo "<h4>&nbsp&nbsp&nbsp VENDRE UN ITEM</h4><br><br>";

$pseudo = $_SESSION['Pseudo'];

$sql = "SELECT * FROM vendeur WHERE Pseudo='$pseudo'"; ?>


<?php affichage_vendeur($con, $sql); ?>

<center>
<a href="moodifierInfoVendeur.php"><button class='btn btn-dark'>Modier les Informations Personnelles</button></a><br><br>
<a href="ajouterItemVendeur.php"><button class='btn btn-dark'>Ajouter un Item</button></a>
<a href="negociationVendeur.php"><button class='btn btn-dark'>Négociation</button></a>
</center>






<?php include("footer/footer.php"); ?>