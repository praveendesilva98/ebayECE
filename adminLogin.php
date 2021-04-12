<?php include("header.php"); 
display_message();
validate_user_login_admin();
include("menu.php");

if(logged_in_admin())
{
    redirect("admin.php");
}   

  ?>

<br><br><h4>&nbsp;&nbsp;LOGIN ADMIN</h4><br><br><br>

<center><form id="login-form" method="post" role="form">
    <div class="form-group">
    <input type="email" name="email_admin" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
    </div>
    <div class="form-group">
    <input type="password" name="password_admin" id="password" tabindex="2" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="login-submit" id="login-submit">LOGIN</button>
    <br/><br/>

</form></center>

<?php include("footer/footer.php");   ?>



