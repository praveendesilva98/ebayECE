<?php include("header.php");
display_message();
include("menu.php"); 

if(!logged_in())
{
    redirect("index.php");
} 

if(isset($_GET['total']))
{
    $total = $_GET['total'];
}

$email = $_SESSION['email'];
$user_details_query = mysqli_query($con, "SELECT * FROM paiement WHERE mail_acheteur = '$email'");
$row = mysqli_fetch_array($user_details_query);
$numero = $row['numero'];
$code = $row['code'];
$nom = $row['nom'];
$date = $row['expiration'];
$type = $row['type'];

?>

<form class="settings_form" action="achat.php?total=<?php echo number_format($total, 2, ',', ' ');; ?>" method="POST">
    <center><table>
        <h4>Montant : <?php echo $total; ?> €</h4>
                
        <td>Type de carte :</td>
            <tr>
                    <td><input type="radio" name="type" value="Visa" id="visa" required /> <label for="visa"><i class="fa fa-cc-visa" style="font-size:36px"></i></label>
                    <input type="radio" name="type" value="Mastercard" id="mastercard" required/> <label for="Mastercard"><i class="fa fa-cc-mastercard" style="font-size:36px"></i></label>
                    <input type="radio" name="type" value="American Express" id="americanexpress" required/> <label for="americanexpress"><i class="fa fa-cc-amex" style="font-size:36px"></i></label> </td>
            </tr>
            <tr>
                <td><br>Numéro de carte :</td>
                <td><br><input type="text" maxlength="16" name="numero" style="font-family: Avenir; font-size: 12 pt; color: black"placeholder="0000-0000-0000-0000" value="<?php echo $numero; ?>" required></td>
            </tr>
                <tr>
                <td><br>Date d'expiration :</td>
                <td><br><input type="text" name="date" style="font-family: Avenir; font-size: 12 pt; color: black"placeholder="01/01" value="<?php echo $date; ?>" required></td>
            </tr>
            <tr>
                <td><br>Code de sécurité :</td>
                <td><br><input type="text" maxlength="3" name="code" style="font-family: Avenir; font-size: 12 pt; color: black"placeholder="CVV" value="<?php echo $code; ?>" required></td>
            </tr>
            <tr>
                <td><br>Titulaire de la carte :</td>
                <td><br><input type="text" name="nom" style="font-family: Avenir; font-size: 12 pt; color: black"placeholder="Nom sur la carte" value="<?php echo $nom; ?>" required></td>
            </tr>
            <tr>
            <td colspan="2" align="center">
                <br>
                <button class="btn btn-outline-secondary btn-lg" name="finaliser_achat">Ajouter</button>
        </td></tr>
    </table></center>
</form><br><br>

<?php

if(isset($_POST['finaliser_achat']))
{
    $type = $_POST['type'];
    $numero = $_POST['numero'];
    $nom = $_POST['nom'];
    $date = $_POST['date'];
    $code = $_POST['code'];

    $sql1 = mysqli_query($con, "SELECT * FROM banque WHERE nom='$nom' AND numero='$numero' AND expiration='$date' AND code='$code' AND type='$type'");
    if(mysqli_num_rows($sql1) > 0)
    {
        $sql2 =  mysqli_query($con, "UPDATE panier SET vendu='1' WHERE user='$email'");
        header("Location: compte.php");
        set_message("<div class='alert alert-success'>Votre achat est validé</div>");

        $subject = "Paiement validé";
        $message = " Please click the link below to activate your Account
        
        http://localhost/ing3/ebay/activate.php?email=$email&code=$validation_code
        ";

        $headers = "From: noreply@ebay-ece.com";


        send_mail($email, $subject, $message, $headers);
    }
    else
    {
        set_message("<div class='alert alert-danger'>Les coordonnées que vous avez saisies sont incorrectes</div>");
    }

}

?>

<?php include("footer/footer.php");   ?>