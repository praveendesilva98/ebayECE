<?php include("header.php");
display_message();
include("menu.php");

if(!logged_in_admin())
{
    redirect("adminLogin.php");
}
if(logged_in())
{
    redirect("logout.php");
}

if(isset($_GET['id_item']))
{
    $id = $_GET['id_item'];
}

$sql= mysqli_query($con, "SELECT * FROM item WHERE id='$id'");
$row = mysqli_fetch_array($sql);

$titre = $row['Nom'];
$image1 = $row['Image1'];
$image2 = $row['Image2'];
$image3 = $row['Image3'];
$prix = $row['Prix'];
$type = $row['typeVente'];
$categorie = $row['Categorie'];
$description = $row['Description'];

?>

<h4>&nbsp&nbsp&nbsp MODIFIER LES INFORMATIONS DE L'ITEM</h4>

<?php

echo "<center>
    <img class='img1' src='$image1' alt='Image1'>
    <img class='img1' src='$image2' alt='Image2'>
    <img class='img1' src='$image3' alt='Image3'><br><br>";

?>   
    <form class='settings_form' method='POST'>

    <?php if(!$image1 == ''): ?>
        <input type='submit' class='btn btn-danger' name='supprimer_photo1' value='Supprimer'>
    <?php endif;  ?>
    <?php if(!$image2 == '' ): ?>
    <input type='submit' class='btn btn-danger' name='supprimer_photo2' value='Supprimer'>
    <?php endif;  ?>
    <?php if(!$image3 == '' ): ?>
    <input type='submit' class='btn btn-danger' name='supprimer_photo3' value='Supprimer'>
    <?php endif;  ?>
    </form>


<br><br>
<form class="settings_form" method="POST">
    <h5>
    <div class="form-group">
        Titre :
        <input type="text" class="form-control" name="titre" value="<?php echo $titre;  ?>">
    </div>
    <div class="form-group">
        Prix : 
        <input type="number" class="form-control" name="prix" value="<?php echo $prix;  ?>"><br><br>
    </div>
    <div class="form-group">
        Catégorie : 
        <input type="text" class="form-control" name="categorie" value="<?php echo $categorie;  ?>"><br><br>
    </div>  
    <div class="form-group">
        Description : 
        <input type="text" class="form-control" name="description" value="<?php echo $description;  ?>"><br><br>
    </div> 

    <input type="submit" class="btn btn-warning" name="modifier_item" value="Modifier">
    <input type="submit" class="btn btn-danger" name="supprimer_item" value="Supprimer l'item">
    </center>

</form><br><br>

<?php

if(isset($_POST['supprimer_photo1']))
{
    $sql = mysqli_query($con, "UPDATE item SET Image1 = '$image2', Image2 = '$image3', Image3 = '' WHERE ID = '$id'");
    set_message("<div class='alert alert-success'>La photo 1 de $titre est supprimée</div>");

}
if(isset($_POST['supprimer_photo2']))
{
    $sql = mysqli_query($con, "UPDATE item SET Image2 = '$image3', Image3 = '' WHERE ID = '$id''");
    set_message("<div class='alert alert-success'>La photo 2 de $titre est supprimée</div>");

}
if(isset($_POST['supprimer_photo3']))
{
    $sql = mysqli_query($con, "UPDATE item SET Image3 = '' WHERE ID = '$id'");
    set_message("<div class='alert alert-success'>La photo 3 de $titre est supprimée</div>");

}

if(isset($_POST['modifier_item']))
{
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];

    $sql = mysqli_query($con, "UPDATE item SET Nom = '$titre',  Prix = '$prix',  Categorie = '$categorie', Description ='$description' WHERE ID='$id'");
    set_message("<div class='alert alert-success'>Les informations sont mises à jour</div>");

}

if(isset($_POST['supprimer_item']))
{
    $sql = mysqli_query($con, "DELETE FROM item WHERE ID = '$id'");
    header("Location: modifierItem.php");
    set_message("<div class='alert alert-danger'>Le vendeur a été supprimé</div>");

}


include("footer/footer.php");



?>