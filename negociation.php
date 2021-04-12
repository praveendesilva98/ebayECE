<?php include("header.php");
display_message();
include("menu.php");

if(!logged_in() && !logged_in_vendeur())
{
    redirect("login.php");
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];
}

$sql = mysqli_query($con, "SELECT * FROM item WHERE ID='$id'");
$row = mysqli_fetch_array($sql);

$prix_vendeur = $row['prix1'];
$prix_acheteur = $row['prix2'];
$offre = $row['Offre'];
$nom = $row['Nom'];
$vendu = $row['Vendu'];

if($vendu==1)
{
    echo "L'item $nom est déjà vendu !";
}
else
{
    $sql1 = "SELECT * FROM item WHERE ID='$id'";

    ?>
    <h4>&nbsp&nbsp&nbsp NEGOCIATION DE L'ITEM</h4><br><br>

    <p>&nbsp&nbsp&nbsp Vous avez négocier <?php echo $offre; ?> fois.
    <br>&nbsp&nbsp&nbsp Au bout de la cinquième négociation, l'item sera vendu automatiquement !
    </p><br><br>

    <center>
    <?php index_item($con, $sql1); ?><br><br>

    <?php if(logged_in()) : ?>
    <form method="POST">
        <table>
            <tr>
                <td><h4>Prix de Vendeur</h4></td>
                <td><h4>&nbsp&nbsp&nbsp</h4></td>
                <td><h4>Prix de l'Acheteur</h4></td>
            </tr>
            <tr>
                <td>
                    <h5><?php echo $prix_vendeur; ?> €</h5>
                </td>
                <td><h4>&nbsp&nbsp&nbsp</h4></td>
                <td>
                    <input type="number" name="prix_acheteur" value="<?php echo $prix_acheteur; ?>">
                </td>
            </tr>
        </table>
        <br><br>
        <?php if($offre < 5): ?>
            <button class="btn btn-dark" name="negocier_acheteur">Négocier</button>
        <?php endif; ?>
            <button class="btn btn-dark" name="accepter_acheteur">Valider</button>
            <button class="btn btn-dark" name="supprimer_acheteur">Rejeter</button>
    </form>
    <?php endif; ?>

    <?php if(logged_in_vendeur()) : ?>
    <form method="POST">
        <table>
            <tr>
                <h5><td>Prix de Vendeur</td>
                <td>Prix de l'Acheteur</td></h5>
            </tr>
            <tr>
                <td>
                    <input type="number" name="prix_vendeur" value="<?php echo $prix_vendeur; ?>">
                </td>
                <td>
                    <h5><?php echo $prix_acheteur; ?> €</h5>
                </td>
            </tr>
        </table>
        <br><br>
        <?php if($offre < 5): ?>
            <button class="btn btn-dark" name="negocier_vendeur">Négocier</button>
        <?php endif; ?>
            <button class="btn btn-dark" name="accepter_vendeur">Valider</button>
            <button class="btn btn-dark" name="supprimer_vendeur">Rejeter</button>
    </form>
    <?php endif; ?>

    </center>

    <?php 

    if(isset($_POST['negocier_acheteur']))
    {
        $montant = $_POST['prix_acheteur'];

        if($montant > 0 && $montant <= $prix_vendeur)
        {
            if($offre < 4)
            {
                $offre = $offre + 1;
                $sql = mysqli_query($con, "UPDATE item SET Offre='$offre', prix2='$montant' WHERE ID ='$id'");
                header("Location: panier.php");  
            }
            else
            {
                header("Location: compte.php");  
                set_message("<div class='alert alert-success'>Vous avez acheté l'item $nom à $prix_acheteur € !</div>");
            }
        }
        else
        {
            set_message("<div class='alert alert-warning'>Veuillez choisir un prix entre $prix_vendeur € et $prix_vendeur €</div>");
        }
    }
    if(isset($_POST['accepter_acheteur']))
    {
        $sql = mysqli_query($con, "UPDATE item SET Vendu='1' WHERE ID ='$id'");
        header("Location: panier.php"); 
        set_message("<div class='alert alert-success'>Vous avez acheté l'item $nom à $prix_vendeur € !</div>");
    }
    if(isset($_POST['supprimer_acheteur']))
    {
        $sql = mysqli_query($con, "UPDATE item SET prix2='0', Offre='0', mail_client=''  WHERE ID ='$id'"); 
        header("Location: panier.php"); 
        set_message("<div class='alert alert-success'>Vous avez acheté l'item $nom à $prix_vendeur !</div>");
    }

    if(isset($_POST['negocier_vendeur']))
    {
        $montant = $_POST['prix_vendeur'];

        if($montant > 0 && $montant <= $prix_vendeur)
        {
            $sql = mysqli_query($con, "UPDATE item SET prix1='$montant' WHERE ID ='$id'");
            header("Location: negociationVendeur.php"); 
        }
        else
        {
            set_message("<div class='alert alert-warning'>Veuillez choisir un prix entre $prix_acheteur € et $prix_vendeur €</div>");
        }
    }
    if(isset($_POST['accepter_vendeur']))
    {
        $sql = mysqli_query($con, "UPDATE item SET Vendu='1' WHERE ID ='$id'");
        header("Location: negociationVendeur.php"); 
        set_message("<div class='alert alert-success'>Vous avez acheté l'item $nom à $prix_acheteur !</div>");
    }
    if(isset($_POST['supprimer_vendeur']))
    {
        $sql = mysqli_query($con, "UPDATE item SET prix2='0', Offre='0', mail_client=''  WHERE ID ='$id'"); 
        header("Location: negociationVendeur.php"); 
        set_message("<div class='alert alert-danger'>Vous avez rejeté l'item $nom à $prix_acheteur !</div>");
    }

}




include("footer/footer.php");    ?>
