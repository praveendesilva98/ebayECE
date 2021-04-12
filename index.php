<?php include("header.php"); ?>	
<?php include("menu.php");  ?>

<div class="jumbotron">
    <center>
        <h1 class="display-4">BIENVENUE CHEZ Ebay ECE</h1>
        <p class="lead">Site e-commerce pour achat des objets de valeurs et d'antiques</p>
        <hr class="my-4">
        <p>⚈ Achat à Enchère &nbsp;&nbsp;
        ⚈ Achat Immédiat &nbsp;&nbsp;
        ⚈ Achat avec Négociation</p>
        <p class="lead">
        <?php if(logged_in()):  ?>
            <a class="btn btn-primary btn-lg" href="compte.php" role="button">MON COMPTE</a>
		<?php endif;  ?>
        <?php if(!logged_in()):  ?>
            <a class="btn btn-primary btn-lg" href="login.php" role="button">LOGIN</a>
        <?php endif;  ?>
        </p>
    </center>
</div>

<h4>&nbsp&nbsp Ferrailles ou Trésor &nbsp&nbsp&nbsp&nbsp<a class="see_more" href="ferrailles_tresor.php">See More ></a></h4>

<?php
$sql1 = "SELECT * FROM item WHERE Categorie = 'Ferrailles ou Trésor' AND typeVente = 'Achat Immédiat' GROUP BY ID DESC LIMIT 4";
?>
<center><div class="container">
    <div class="row">
    <?php index_item($con, $sql1); ?>
    </div>
</div></center>



<hr><br>

<h4>&nbsp&nbsp Bon pour le Musée &nbsp&nbsp&nbsp&nbsp<a class="see_more" href="bon_musee.php">See More ></a></h4>

<?php
$sql2 = "SELECT * FROM item WHERE Categorie = 'Bon pour le Musée' AND typeVente = 'Achat Immédiat' GROUP BY ID DESC LIMIT 4";
?>
<center><div class="container">
    <div class="row">
    <?php index_item($con, $sql2); ?>
    </div>
</div></center>

<hr><br>

<h4>&nbsp&nbsp Accessoires VIP &nbsp&nbsp&nbsp&nbsp<a class="see_more" href="accessoires_vip.php">See More ></a></h4>

<?php
$sql3 = "SELECT * FROM item WHERE Categorie = 'Accessoires VIP' AND typeVente = 'Achat Immédiat' GROUP BY ID DESC LIMIT 4";
?>

<center><div class="container">
    <div class="row">
    <?php index_item($con, $sql3); ?>
    </div>
</div></center>

<br><br>




<?php include("footer/footer.php");   ?>

