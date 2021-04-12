<?php include("header.php"); 
display_message(); 
include("menu.php"); ?>

<h4><h4>&nbsp&nbsp&nbsp BON POUR LE MUSEE</h4>

<?php
$sql = "SELECT * FROM item WHERE Categorie = 'Bon pour le Musée' AND typeVente='Achat Immédiat' GROUP BY ID DESC";

display_item($con, $sql); ?>




<?php include("footer/footer.php"); ?>