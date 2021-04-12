<?php include("header.php"); 
display_message();
validate_user_login_vendeur(); // from validate_user_login_admin()
include("menu.php");

if(logged_in_vendeur()) // from logged_in_admin()
{
    redirect("vendre.php");
}   

  ?>

<br><br><h2>&nbsp;&nbsp;LOGIN VENDEUR</h2><br><br><br>

<center><form id="login-form" method="post" role="form">
    <div class="form-group">
    <input type="text" name="pseudo_vendeur" id="pseudo_vendeur" tabindex="1" class="form-control" placeholder="Pseudo" value="" required>
    </div>
    <div class="form-group">
    <input type="password" name="password_vendeur" id="password_vendeur" tabindex="2" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="login-submit" id="login-submit">LOGIN</button>
    <br/><br/>
    <a href="creerVendeur.php"><h5>Don't have an account yet ? Register in here</h5></a>

</form></center>

<?php include("footer/footer.php");   ?>



