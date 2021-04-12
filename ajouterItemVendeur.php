<?php 
include("header.php"); 
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

?>

<h4>&nbsp&nbsp&nbsp AJOUTER UN ITEM</h4><br>

<div class="body-content">


    <center><form id="ajouter-item-form" method="post" role="form" enctype="multipart/form-data">

        <div class="form-group">
            <input type="text" name="titre" id="titre" class="form-control" placeholder="Titre" required>
        </div>

        Image 1 : <input type="file" name="image1" id="image1" required><br><br>

        Image 2 : <input type="file" name="image2" id="image2" required><br><br>

        Image 3 : <input type="file" name="image3" id="image3" required><br><br>

        Vidéo : <input type="file" name="video" id="video"><br><br>

        <div class="form-group">
            <input type="number" name="prix" id="prix" class="form-control" placeholder="Prix" required>
        </div>

        <div class="form-group">
            <select name='type' id='type' placeholder="Type" required>
                <option value="Achat Immédiat">Achat Immédiat</option>
                <option value="Achat à Enchère">Achat à Enchère</option>
                <option value="Meilleure Offre">Meilleure Offre</option>
            </select>
        </div>

        <div class="form-group">
            <select name='categorie' id='categorie' placeholder="Categorie" required>
                <option value="Ferrailles ou Trésor">Ferrailles ou Trésor</option>
                <option value="Bon pour le Musée">Bon pour le Musée</option>
                <option value="Accessoires VIP">Accessoires VIP</option>
            </select>
        </div>

        <div class="form-group">
            <textarea  name="description" id="description" class="form-control" cols="100" rows="5" placeholder="Description" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="ajouter_item" id="register-submit">ENREGISTRER</button>

    </form></center><br><br>
</div>
                    



<?php include("footer/footer.php");



?>