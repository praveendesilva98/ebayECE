<?php include("header.php");
display_message();
recover_password();
include("menu.php"); ?>

    

    <br><br><h4>&nbsp;&nbsp;REINITIALISER VOTRE MOT DE PASSE</h4><br><br><br>

    <center><form id="recover-form" method="post" role="form" autocomplete="off">
        <div class="form-group">
            <h4><label for="email">Enter your Email Address :</label><br></h4>
            <input type="email" name="email" id="email" tabindex="1"  class="form-control" placeholder="Email Address" autocomplete="off" /> 
        </div>
        <button type="submit" class="btn btn-danger" name="cancel_submit" id="cancel-submit">Cancel</button>
        <button type="submit" class="btn btn-success" name="recover_submit" id="recover-submit">Send Password Reset Link</button>
        <input type="hidden" class="hide" name="token" value="<?php echo token_generator();    ?>">
    </form></center>
	

    </body>

    <?php include("footer/footer.php");   ?>

</html>