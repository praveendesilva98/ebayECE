<?php include("header.php"); 
display_message(); 
include("menu.php");?>

<h4>&nbsp&nbsp&nbsp ACHAT A ENCHERE</h4>
<?php
$sql = "SELECT * FROM item WHERE typeVente = 'Achat à Enchère' GROUP BY ID DESC";

display_item($con, $sql);

include("footer/footer.php"); ?>