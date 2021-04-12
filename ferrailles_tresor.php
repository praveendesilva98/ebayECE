<?php include("header.php"); display_message(); 
include("menu.php");

?>

<h4>&nbsp&nbsp&nbsp FERRAILLES OU TRESOR</h4>

<?php

$sql = "SELECT * FROM item WHERE Categorie = 'Ferrailles ou Trésor' AND typeVente = 'Achat Immédiat' GROUP BY ID DESC";

display_item($con, $sql); ?>





<?php include("footer/footer.php"); ?>