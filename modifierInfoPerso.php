<?php  include("header.php"); 
display_message(); 
include("menu.php");


    $email = $_SESSION['email'];
    $user_data_query = mysqli_query($con, "SELECT * FROM acheteur WHERE email='$email'");
    $row = mysqli_fetch_array($user_data_query);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $address1 = $row['Adresse1'];
    $address2 = $row['Adresse2'];
    $city = $row['Ville'];
    $zip = $row['CodePostal'];
    $country = $row['Pays'];
    $tel = $row['Telephone'];
?>
<div class="form">

<h4>&nbsp&nbsp&nbspMODIFIER LES INFORMATIONS PERSONNELLES</h4>

    <form class="settings_form" action="modifierInfoPerso.php" method="POST">
        <h6>
        <div class="form-group">
        Nom : <input class="form-control" type="text" name="nom" value="<?php echo $first_name;  ?>">
        </div>
        <div class="form-group">
        Prénom: <input class="form-control" type="text" name="prenom" value="<?php echo $last_name;  ?>"><br><br>
        </div>
        <div class="form-group">
        Adresse Ligne 1: <input type="text" class="form-control" name="adresse1" value="<?php echo $address1;  ?>"><br><br>
        </div>
        <div class="form-group">
        Adresse Ligne 2: <input type="text" class="form-control" name="adresse2" value="<?php echo $address2;  ?>"><br><br>
        </div>
        <div class="form-group">
        Code Postal : <input type="text" class="form-control" name="zip" value="<?php echo $zip;  ?>"><br><br>
        </div>
        <div class="form-group">
        Ville : <input type="text" class="form-control" name="ville" value="<?php echo $city;  ?>"><br><br>
        </div>
        <div class="form-group">
        Pays : <input type="text" class="form-control" name="pays" value="<?php echo $country;  ?>"><br><br>
        </div>
        <div class="form-group">
        Numéro de Téléphone : <input type="text" class="form-control" name="tel" value="<?php echo $tel;  ?>"><br><br></h6>
        </div></center>
        <center><input type="submit" class="btn btn-success" name="update_details" id="save_details" value="Mettre à jour">
        </form></center><br><br>

    <center><div class="text"><h5>Changer le Mot de Passe</h5><br></div>
    <form class="settings_form" action="modifierInfoPerso.php" method="POST">
        <h6>
        <div class="form-group">
        Old Password: <input class="form-control" type="password" name="old_password"><br><br>
        </div>
        <div class="form-group">
        New Password: <input class="form-control" type="password" name="new_password_1"><br><br>
        </div>
        <div class="form-group">
        Confirm New Password: <input class="form-control" type="password" name="new_password_2"></h8><br><br>
        </div>
        <input type="submit" class="btn btn-success" name="update_password" id="save_details" value="Changer le Mot de Passe">
    </form><br><br><br><br>

    <form class="settings_form" action="modifierInfoPerso.php" method="POST">
        <button class="btn btn-danger" name="delete_account">Supprimer le compte</button><br><br>
    </form></center>

</div>

<?php

if(isset($_POST['update_details']))
{
    $first_name = $_POST['nom'];
    $last_name = $_POST['prenom'];
    $address1 = $_POST['adresse1'];
    $address2 = $_POST['adresse2'];
    $city = $_POST['ville'];
    $zip = $_POST['zip'];
    $country = $_POST['pays'];
    $tel = $_POST['tel'];

    $sql2 = mysqli_query($con, "UPDATE acheteur SET first_name = '$first_name', last_name = '$last_name', Adresse1 = '$address1', 
    Adresse2 = '$address2', Ville = '$city', CodePostal = '$zip', Pays = '$country', Telephone = '$tel' WHERE email='$email'");

}
else
{
    echo "<p><h3></p><br><br>";
}

if(isset($_POST['update_password']))
{
    $old_password = $_POST['old_password'];
    $new_password_1 = $_POST['new_password_1'];
    $new_password_2 = $_POST['new_password_2'];

    $password_query = mysqli_query($con, "SELECT password FROM acheteur WHERE email = '$email'");
    $row = mysqli_fetch_array($password_query);
    $db_password = $row['password'];

    if(md5($old_password) == $db_password)
    {
        if($new_password_1 = $new_password_2)
        {
            $new_password_md5 = md5($new_password_1);
            $password_query = mysqli_query($con, "UPDATE acheteur SET password = '$new_password_md5' WHERE email = '$email'");
            echo "<p><h3>Le mot de passe a été modifié !</h3></p><br><br>";           
        }
        else
        {
            echo "<p><h3>Les deux mots de passes sont différents !</h3></p><br><br>";
        }
    }
    else
    {
        echo "<p><h3>L'ancien mot de passe est incorrect !</h3></p><br><br>";
    }
    
}
else
{
    echo "<p><h3></h3></p><br><br>";
}

if(isset($_POST['delete_account']))
{
    $close_query = mysqli_query($con, "DELETE FROM acheteur WHERE email = '$email'");
    session_destroy();
    header("Location: login.php");
                
}   

 include("footer/footer.php"); ?>