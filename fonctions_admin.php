<?php

if(isset($_POST['ajouter-vendeur']))
{
    $nom = $_POST['nom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $fond = $_POST['fond'];

    $uploadOk = 1;
    $imageName = $_FILES['fileToUpload']['name'];
    $errorMessage = "";

    if($imageName != "")
    {
        $targetDir = "profil/";
        $imageName = $targetDir . uniqid() . basename($imageName);
        $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

        if($_FILES['fileToUpload']['size'] > 100000000)
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, votre fichier est très large</div>";
            $uploadOk = 0;
        }

        if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg")
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, seulement jpeg, jpg et png sont acceptés</div>";
            $uploadOk = 0;
        }

        if($uploadOk)
        {
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName))
            {

            }
            else
            {
                $uploadOk = 0;
            }
        }
    }

    if($uploadOk)
    {
        $sql = mysqli_query($con, "SELECT * FROM vendeur WHERE Pseudo ='$pseudo' OR Mail='$email'");

        if(mysqli_num_rows($sql) == 0)
        {
            $sql2 = mysqli_query($con, "INSERT INTO vendeur(Nom, Pseudo, Mail, Photo, Fond) VALUES ('$nom', '$pseudo', '$email', '$imageName', '$fond')");
            echo "<div class='alert alert-success'>Le vendeur $pseudo est ajouté avec succès</div>";
        }
        else
        {
            echo "<div class='alert alert-warning'>Un vendeur avec le même pseudo ou le même adresse mail existe déjà</div>";
        }
        
    }
    else
    {
        echo $errorMessage;
    }
} 

if(isset($_POST['ajouter-item-achat']))
{
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $type = $_POST['type'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];

    $upload1 = 1;
    $upload2 = 1;
    $upload3 = 1;
    $upload4 = 1;
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    $video = $_FILES['video']['name'];
    $errorMessage = "";

    if($image1 != "" && $image2 != "" && $image3 != "")
    {
        $targetDir = "item/achat/";
        $image1 = $targetDir . uniqid() . basename($image1);
        $image2 = $targetDir . uniqid() . basename($image2);
        $image3 = $targetDir . uniqid() . basename($image3);
        $video = $targetDir . uniqid() . basename($video);
        $imageFileType1 = pathinfo($image1, PATHINFO_EXTENSION);
        $imageFileType2 = pathinfo($image2, PATHINFO_EXTENSION);
        $imageFileType3 = pathinfo($image3, PATHINFO_EXTENSION);
        $videoFileType = pathinfo($video, PATHINFO_EXTENSION);

        if($_FILES['image1']['size'] > 100000000)
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, votre fichier Image 1 est très large</div>";
            $upload1 = 0;
        }

        if($_FILES['image2']['size'] > 100000000)
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, votre fichier Image 2 est très large</div>";
            $upload2 = 0;
        }

        if($_FILES['image3']['size'] > 100000000)
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, votre fichier Image 3 est très large</div>";
            $upload3 = 0;
        }

         if($_FILES['video']['size'] > 100000000)
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, votre vidéo est très large</div>";
            $upload4 = 0;
        } 

        if(strtolower($imageFileType1) != "jpeg" && strtolower($imageFileType1) != "png" && strtolower($imageFileType1) != "jpg")
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, seulement jpeg, jpg et png sont acceptés</div>";
            $upload1 = 0;
        }

        if(strtolower($imageFileType2) != "jpeg" && strtolower($imageFileType2) != "png" && strtolower($imageFileType2) != "jpg")
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, seulement jpeg, jpg et png sont acceptés</div>";
            $upload2 = 0;
        }

        if(strtolower($imageFileType3) != "jpeg" && strtolower($imageFileType3) != "png" && strtolower($imageFileType3) != "jpg")
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, seulement jpeg, jpg et png sont acceptés</div>";
            $upload3 = 0;
        }

         if(strtolower($videoFileType) != "mp4")
        {
            $errorMessage = "<div class='alert alert-warning' role='alert'>Désolé, seulement mp4 est accepté</div>";
            $upload4 = 0;
        } 

        if($upload1)
        {
            if(move_uploaded_file($_FILES['image1']['tmp_name'], $image1))
            {

            }
            else
            {
                $upload1 = 0;
            }
        }
        if($upload2)
        {
            if(move_uploaded_file($_FILES['image2']['tmp_name'], $image2))
            {

            }
            else
            {
                $upload2 = 0;
            }
        }
        if($upload3)
        {
            if(move_uploaded_file($_FILES['image3']['tmp_name'], $image3))
            {

            }
            else
            {
                $upload3 = 0;
            }
        }
        if($upload4)
        {
            if(move_uploaded_file($_FILES['video']['tmp_name'], $video))
            {

            }
            else
            {
                $upload4 = 0;
            }
        } 
    }

    if($upload1 && $upload2 && $upload3)
    {
        if($type == 'Achat à Enchères')
        {
            $sql2 = mysqli_query($con, "INSERT INTO item(Nom, Image1, Image2, Image3, Video, prix1, typeVente, Categorie, Description) VALUES ('$titre', '$image1', '$image2','$image3', '$video', '$prix', '$type', '$categorie', '$description')");
        }
        else if($type == 'Meilleure Offre')
        {
            $sql2 = mysqli_query($con, "INSERT INTO item(Nom, Image1, Image2, Image3, Video, Prix, prix1, typeVente, Categorie, Description) VALUES ('$titre', '$image1', '$image2','$image3', '$video', '$prix', '$prix', '$type', '$categorie', '$description')");
        }
        else
        {
            $sql2 = mysqli_query($con, "INSERT INTO item(Nom, Image1, Image2, Image3, Video, Prix, typeVente, Categorie, Description) VALUES ('$titre', '$image1', '$image2','$image3', '$video', '$prix', '$type', '$categorie', '$description')");
        }
        header("Location: admin.php");
        
    }
    else
    {
        echo $errorMessage;
    }


} 




?>