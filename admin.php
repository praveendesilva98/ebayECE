<?php include("header.php");
 display_message(); 
include("menu.php");

if(!logged_in_admin())
{
    redirect("adminLogin.php");
}
if(logged_in())
{
    redirect("logout.php");
}

?>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-4" id="myScrollspy">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                <a class="nav-link active" href="#section1">Vendeurs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="#section2">Items</a>
                </li>
            </ul>
            </nav>
            <div class="col-sm-9 col-8">
            <h4>ADMIN</h4><br>
            <div id="section1">
                <h4>Vendeurs</h4><br>

                <h5><a href="ajouterVendeur.php" class="lien">Ajouter un Vendeur</a></h5>
                <h5><a href="modifierVendeur.php" class="lien">Modifier un Vendeur</a></h5>
                <h5><a href="nouveauxVendeurs.php" class="lien">Nouveaux Vendeurs</a></h5>
                 
            </div>
            <div id="section2">
                <h4>Items</h4><h6><br>

                <h5><a href="ajouterItem.php" class="lien">Ajouter un Item</a></h5>
                <h5><a href="modifierItem.php" class="lien">Modifier un Item</a></h5>

            </div>
        
        </div>
    </div> 

</body>


<?php include("footer/footer.php"); ?>