<?php include("header.php"); 
display_message(); 
include("menu.php");?>

<h4>&nbsp&nbsp&nbsp ACHAT IMMEDIAT</h4><br>

<?php $sql = "SELECT * FROM item WHERE typeVente = 'Achat Immédiat' GROUP BY ID DESC";

display_item($con, $sql);

include("footer/footer.php"); ?>