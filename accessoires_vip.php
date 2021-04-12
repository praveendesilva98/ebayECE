<?php include("header.php"); display_message(); 
include("menu.php"); ?>

<h4>&nbsp&nbsp&nbsp ACCESSOIRES VIP</h4>

<?php
$sql = "SELECT * FROM item WHERE Categorie = 'Accessoires VIP' AND typeVente = 'Achat Immédiat' GROUP BY ID DESC";

display_item($con, $sql);

include("footer/footer.php"); ?>