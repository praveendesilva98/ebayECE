<?php include("header.php"); 
display_message(); ?>	

<?php include("menu.php");  ?>



<?php

if(!logged_in())
{
    redirect("index.php");
}
if(logged_in_vendeur())
{
    redirect("vendeurLogout.php");
}
if(logged_in_admin())
{
    redirect("adminLogout.php");
}

    $email = $_SESSION['email'];
    $user_details_query = mysqli_query($con, "SELECT * FROM acheteur, paiement WHERE acheteur.email = '$email' AND paiement.mail_acheteur = '$email'");
    $row = mysqli_fetch_array($user_details_query);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $address1 = $row['Adresse1'];
    $address2 = $row['Adresse2'];
    $city = $row['Ville'];
    $zip = $row['CodePostal'];
    $country = $row['Pays'];
    $tel = $row['Telephone'];
    $numero = $row['numero'];
    $crypt_numero = str_repeat("*", strlen($numero)); 
    $code = $row['code'];
    $crypt_code = str_repeat("*", strlen($code)); 
    $nom = $row['nom'];
    $date = $row['expiration'];
    $type = $row['type'];


    ?>
    
<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">

    <div class="container-fluid">
      <div class="row">
          <nav class="col-sm-3 col-4" id="myScrollspy">
          <ul class="nav nav-pills flex-column">
              <li class="nav-item">
              <a class="nav-link active" href="#section1">Coordonnées Personnelles</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" href="#section2">Coordonnées Bancaires</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" href="#section3">Mes Achats</a>
              </li>
          </ul>
          </nav>
          <div class="col-sm-9 col-8">
          <h4>MON COMPTE</h4><br>
            <div id="section1">
                <h4>Coordonnées Personnelles</h4><h6><a href="modifierInfoPerso.php">Modifier ></a></h6><br>
                <h6> <?php echo 
                    "Nom : $first_name <br><br>
                    Prénom : $last_name <br><br>
                    Adresse : $address1, $address2 $zip $city, $country <br><br>
                    Numéro de téléphone : $tel"; ?><br></h6>
            </div>
            <div id="section2">
                <h4>Coordonnées Banciares</h4><h6><a href="ajouterCarte.php">Modifier ></a></h6><br>
                <h6> <?php echo 
                "Type de carte : $type<br><br>
                Numéro de la carte : $crypt_numero<br><br>
                Nom de la carte :  $nom<br><br>
                Date d'expiration : $date<br><br>
                Code de Sécurité : $crypt_code"; ?><br></h6>

            </div>

            <div id="section3">
                <h4>Mes Achats</h4><br>
                <?php
                $sql1 = "SELECT * FROM item WHERE mail_client='$email' AND Vendu='1' GROUP BY id DESC LIMIT 4"; ?>
                <div class="row">
                <?php compte_item($con, $sql1); ?>
                </div>
                

            </div>
          
          </div>
      </div> 

</body>

<?php include("footer/footer.php");   ?>

