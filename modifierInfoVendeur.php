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

$pseudo = $_SESSION['Pseudo'];

$sql= mysqli_query($con, "SELECT * FROM vendeur WHERE Pseudo='$pseudo'");
$row = mysqli_fetch_array($sql);

$nom = $row['Nom'];
$email = $row['Mail'];
$fond = $row['Fond'];
$active = $row['Active'];
$photo = $row['Photo'];?>

<h4>&nbsp&nbsp&nbspMODIFIER LES INFORMATIONS PERSONNELLES</h4>
<?php
echo "<center><div class='card' style='width: 18rem;'>
      <img class='card-img-top' src='$photo' alt='Profile Photo'>
    </div>";


if($photo != "profil/profil_random.png")
{
    echo "<form class='settings_form' method='POST'>

    <input type='submit' class='btn btn-danger' name='supprimer-photo' value='Supprimer la photo'><br><br>
    </form>";
}

?>
<form class="settings_form" method="POST">
    <h6>
    <div class="form-group">
        Nom : <input type="text" name="nom" class="form-control" value="<?php echo $nom;  ?>">
    </div>
    <div class="form-group">
        Pseudo : <input type="text" name="pseudo" class="form-control" value="<?php echo $pseudo;  ?>"><br><br>
    </div>
    <div class="form-group">
        Mail : <input type="text" name="email" class="form-control" value="<?php echo $email;  ?>"><br><br>
    </div>
    <div class="form-group">
        Fond : <input type="number" name="fond" class="form-control" value="<?php echo $fond;  ?>"><br><br>
    </div>

    <input type="submit" class="btn btn-warning" name="modifier-vendeur" value="Modifier">
    <input type="submit" class="btn btn-danger" name="supprimer-vendeur" value="Supprimer le Compte">

</form><br><br>

<?php

if(isset($_POST['supprimer-photo']))
{
    $image = "profil/profil_random.png";
    $sql = mysqli_query($con, "UPDATE vendeur SET Photo = '$image' WHERE Pseudo ='$pseudo'");
    set_message("<div class='alert alert-success'>La photo de profil de $pseudo est supprimée</div>");

}

if(isset($_POST['modifier-vendeur']))
{
    $nom = $_POST['nom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $fond = $_POST['fond'];

    $sql = mysqli_query($con, "SELECT * FROM vendeur WHERE Pseudo ='$pseudo' OR Mail='$email'");

    if(mysqli_num_rows($sql) == 0)
    {
        $sql = mysqli_query($con, "UPDATE vendeur SET Nom = '$nom',  Pseudo = '$pseudo',  Mail = '$email', Fond ='$fond' WHERE ID='$id'");
        set_message("<div class='alert alert-success'>Les informations de $pseudo sont mises à jour</div>");
    }
    else
    {
        set_message("<div class='alert alert-warning'>Un vendeur avec le même pseudo ou le même adresse mail existe déjà</div>");
    }

    

}

if(isset($_POST['supprimer-vendeur']))
{
    $sql = mysqli_query($con, "DELETE FROM vendeur WHERE Pseudo = '$pseudo'");
    header("Location: modifierVendeur.php");
    set_message("<div class='alert alert-danger'>Le vendeur a été supprimé</div>");

}


?>





<?php include("footer/footer.php"); ?>