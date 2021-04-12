<?php include("header.php");  
display_message(); ?>
<?php include("menu.php");  ?>


        <br><br><h4>&nbsp;&nbsp;ENTRER LE CODE</h4><br><br><br>


        <?php display_message();   ?>

        <?php validate_code();  ?>



        <center><form id="code-form" method="post" role="form" autocomplete="off">
        <div class="form-group">
        <input type="password" name="code" id="code" tabindex="1" placeholder="##########" class="form-control">
        </div>
        <button type="submit" class="btn btn-danger" name="code-cancel" id="code-cancel">CANCEL</button>
        <button type="submit" class="btn btn-success"name="code-submit" id="recover-submit">CONTINUE</button>
        <input type="hidden" class="hide" name="token" value="">
        <br/><br/>

    </form></center>

</header>

</body>

</html>
