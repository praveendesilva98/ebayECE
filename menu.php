<header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><div class="logo">Ebay ECE</div></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="categories.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                CATEGORIES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ferrailles_tresor.php">FERRAILLES OU TRESOR</a>
                    <a class="dropdown-item" href="bon_musee.php">BON POUR LE MUSEE</a>
                    <a class="dropdown-item" href="accessoires_vip.php">ACCESSOIRE VIP</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="achat.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ACHAT
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="achatEncheres.php">ENCHERES</a>
                    <a class="dropdown-item" href="acheter_maintenant.php">ACHETER MAINTENANT</a>
                    <a class="dropdown-item" href="achatMeilleuresOffres.php">MEILLEURES OFFRES</a>
                </div>
            </li>

            <?php if(logged_in_vendeur()):  ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="vendre.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                VENDRE</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="vendre.php">COMPTE VENDEUR</a>
                    <a class="dropdown-item" href="modifierInfoVendeur.php">MODIFIER</a>
                    <a class="dropdown-item" href="ajouterItemVendeur.php">AJOUTER UN ITEM</a>
                </div>
            </li>
            <?php endif; ?>

            <li class="nav-item">
                <?php if(!logged_in_vendeur()):  ?>
                    <a class="nav-link" href="vendeurLogin.php">VENDRE</a>
                <?php endif;  ?>
            </li>

            <li class="nav-item">
                <?php if(logged_in()):  ?>
                    <a class="nav-link" href="compte.php">VOTRE COMPTE</a>
				<?php endif;  ?>
				<?php if(!logged_in()):  ?>
					<a class="nav-link" href="login.php">VOTRE COMPTE</a>
				<?php endif;  ?>
            </li>

            
            <?php if(!logged_in_admin()):  ?>
            <li class="nav-item">
                <a class="nav-link" href="adminLogin.php">ADMIN</a>
            </li>
            <?php endif;  ?>

            <li class="nav-item dropdown">
            <?php if(logged_in_admin()):  ?>
                <a class="nav-link dropdown-toggle" href="admin.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ADMIN
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="admin.php">COMPTE ADMIN</a>
                    <a class="dropdown-item" href="ajouterVendeur.php">AJOUTER UN VENDEUR</a>
                    <a class="dropdown-item" href="modifierVendeur.php">MODIFIER UN VENDEUR</a>
                    <a class="dropdown-item" href="nouveauxVendeurs.php">NOUVEAUX VENDEURS</a>
                    <a class="dropdown-item" href="ajouterItem.php">AJOUTER UN ITEM</a>
                    <a class="dropdown-item" href="modifierItem.php">MODIFIER UN ITEM</a>
                </div>
            </li>
            <?php endif;  ?>

            <li class="nav-item">
                <?php if(logged_in()):  ?>
                    <a class="nav-link" href="panier.php"><i class="fa fa-shopping-cart" style="font-size:30px"></i></a>
                <?php endif;  ?>
            </li>

            <li class="nav-item">
                <?php if(logged_in()):  ?>
                    <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" style="font-size:30px;color:red"></i></a>
                <?php endif;  ?>
            </li>

            <li class="nav-item">
                <?php if(logged_in_vendeur()):  ?>
                    <a class="nav-link" href="vendeurLogout.php"><i class="fa fa-sign-out" style="font-size:30px;color:red"></i></a>
                <?php endif;  ?>
            </li>

            <li class="nav-item">
                <?php if(logged_in_admin()):  ?>
                    <a class="nav-link" href="adminLogout.php"><i class="fa fa-sign-out" style="font-size:30px;color:red"></i></a>
                <?php endif;  ?>
            </li>

            

        </ul>

    </div>
</nav>

</header>
<?php
if(isset($_SESSION['Pseudo']))
{
    $pseudo = $_SESSION['Pseudo'];
    $sql = mysqli_query($con, "SELECT * FROM vendeur WHERE Pseudo='$pseudo'");
    $row = mysqli_fetch_array($sql);
    
    $fond = $row['Fond'];
    echo "<body style='background-color:$fond;'>";
}
else
{
    echo "<body>";
}

?>



