<?php include("header.php"); 
display_message(); 
include("menu.php");?>

<h4>&nbsp&nbsp&nbsp MEILLEURES OFFRES</h4>
<?php
$sql = "SELECT * FROM item WHERE typeVente='Meilleure Offre' AND prix2='0' AND Vendu='0' GROUP BY ID DESC LIMIT 20";

display_item($con, $sql);

include("footer/footer.php"); ?>