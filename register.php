<?php include("header.php");  ?>
<?php validate_user_registration();  ?>
<?php include("menu.php");  ?>
        
        
        <br><br><h4>&nbsp;&nbsp;&nbsp;&nbsp;CREER UN COMPTE</h4><br><br><br>

        <div class="body-content">
            

        <center><form id="register-form" method="post" role="form">
        <div class="form-group">
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Nom" value="<?php
            if(isset($_SESSION['first_name']))
            {
                echo $_SESSION['first_name'];
            }
            ?>" required>
        </div>

        <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Prénom" value="<?php
            if(isset($_SESSION['last_name']))
            {
                echo $_SESSION['last_name'];
            }
            ?>" required>
        </div>

        
        <div class="form-group">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php
                if(isset($_SESSION['email']))
                {
                    echo $_SESSION['email'];
                }
                ?>" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Mot de Passe" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirmer le mot de Passe" required> 
        </div>

        <div class="form-group">
        <input type="text" name="address1" id="address1" class="form-control" placeholder="Adresse Ligne 1" value="<?php
                if(isset($_SESSION['Adresse1']))
                {
                    echo $_SESSION['Adresse1'];
                }
                ?>" required>
        </div>

        <div class="form-group">
        <input type="text" name="address2" id="address2" class="form-control" placeholder="Adresse Ligne 2" value="<?php
                if(isset($_SESSION['Adresse2']))
                {
                    echo $_SESSION['Adresse2'];
                }
                ?>">
        </div>

        <div class="form-group">
        <input type="text" name="zip" id="zip" class="form-control" placeholder="Code Postal" value="<?php
                if(isset($_SESSION['CodePostal']))
                {
                    echo $_SESSION['CodePostal'];
                }
                ?>" required>
        </div>

        <div class="form-group">
        <input type="text" name="city" id="city" class="form-control" placeholder="Ville" value="<?php
                if(isset($_SESSION['Ville']))
                {
                    echo $_SESSION['Ville'];
                }
                ?>" required>
        </div>

        <div class="form-group">
        <input type="text" name="country" id="country" class="form-control" placeholder="Pays" value="<?php
                if(isset($_SESSION['Pays']))
                {
                    echo $_SESSION['Pays'];
                }
                ?>" required>
        </div>

        <div class="form-group">
        <input type="text" name="tel" id="tel" class="form-control" placeholder="Téléphone" value="<?php
                if(isset($_SESSION['Telephone']))
                {
                    echo $_SESSION['Telephone'];
                }
                ?>" required>
        </div>

        <button type="submit" class="btn btn-primary" name="register-submit" id="register-submit">REGISTER</button>

        <div class="text">
            <br><h5><a href="login.php">Already have an account ? Sign in here</a></h5><br><br>
        </div>

    </form></center>

</body>

<?php include("footer/footer.php");   ?>

</html>