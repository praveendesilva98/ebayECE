<?php 
include("header.php"); display_message(); 
include("menu.php");


if(logged_in())
{
    redirect("logout.php");
    redirect("vendeurLogin.php");
}
?>

<h4>&nbsp&nbsp&nbsp CREER UN COMPTE VENDEUR</h4><br>

<div class="body-content">
            

    <center><form id="ajouter-item-form" method="post" role="form" enctype="multipart/form-data">

        Photo de Profil : <input type="file" name="fileToUpload" id="fileToUpload" required><br><br>

        <div class="form-group">
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
        </div>

        <div class="form-group">
            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="form-group">
            <select name="fond" id="fond" class="form-control" placeholder="Fond" required>
            <option value="#FFFFFF">Blanc</option>
            <option value="#DC143C">Rouge</option>
            <option value="#A9A9A9">Gris</option>
            <option value="#FF8C00">Orange</option>
            <option value="##9932CC">Violet</option>
            <option value="#1E90FF">Bleu</option>
            <option value="##ADFF2F">Vert</option>
            <option value="#FFD700">Jaune</option>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Mot de Passe" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirmer le mot de Passe" required> 
        </div>

        <button type="submit" class="btn btn-primary" name="ajouter_vendeur" id="register-submit">ENREGISTRER</button>

    </form></center><br><br>
</div>




<?php include("footer/footer.php");



?>