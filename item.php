<?php

    
function create_item($con, $id)
{
    $data_query = mysqli_query($con, "SELECT * FROM item WHERE id = $id  AND prix2='0' AND Vendu='0'");

    if(mysqli_num_rows($data_query) > 0)
    {
        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $titre = $row['Nom'];
            $image1 = $row['Image1'];
            $image2 = $row['Image2'];
            $image3 = $row['Image3'];
            $video = $row['Video'];
            $price = $row['Prix'];
            $prix = number_format($price, 2, ',', ' ');
            $categorie = $row['Categorie'];
            $description = $row['Description'];
            $type = $row['typeVente'];
            $offre = $row['Offre'];
            $vendu = $row['Vendu'];
            
            if($type == "Achat Immédiat")
            {
                $str = "
            
                <center>
                <div id='carousel-thumb' class='carousel slide carousel-fade carousel-thumbnails' data-ride='carousel'>
                    <!--Slides-->
                    <div class='carousel-inner' role='listbox'>
                        <div class='carousel-item active'>
                        <img class='d-block w-50' src='$image1'
                            alt='First slide'>
                        </div>
                        <div class='carousel-item'>
                        <img class='d-block w-50' src='$image2'
                            alt='Second slide'>
                        </div>
                        <div class='carousel-item'>
                        <img class='d-block w-50' src='$image3'
                            alt='Third slide'>
                        </div>
                        <div class='carousel-item'>
                            <video class='video-fluid w-50' autoplay loop muted>
                                <source src='$video' type='video/mp4'/>
                            </video>
                        </div>
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class='carousel-control-prev' href='#carousel-thumb' role='button' data-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Previous</span>
                    </a>
                    <a class='carousel-control-next' href='#carousel-thumb' role='button' data-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Next</span>
                    </a>
                </div><br><br>
                <h2>$titre</h2><br><br>

                <div class='container'>
                    <div class='row'>
                        <div class='col-8'>
                            <h4>DESCRIPTION</h4><br>
                            <h6>Catégorie : $categorie <br>
                            Type de Vente : $type</h6><br>
                            $description
                        </div>
                        <div class='col-4'>
                            <h4>$prix €</h4>
                            <form action='article.php?id=$id' method='post'>
                                <button name='ajouter_panier' class='btn btn-primary'>Ajouter au Panier<i class='fa fa-shopping-cart' style='font-size:30px'></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                </center>";
            }
            else if($type == "Achat à Enchère")
            {
                $str = "
            
                <center>
                <div id='carousel-thumb' class='carousel slide carousel-fade carousel-thumbnails' data-ride='carousel'>
                    <!--Slides-->
                    <div class='carousel-inner' role='listbox'>
                        <div class='carousel-item active'>
                        <img class='d-block w-50' src='$image1'
                            alt='First slide'>
                        </div>
                        <div class='carousel-item'>
                        <img class='d-block w-50' src='$image2'
                            alt='Second slide'>
                        </div>
                        <div class='carousel-item'>
                        <img class='d-block w-50' src='$image3'
                            alt='Third slide'>
                        </div>
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class='carousel-control-prev' href='#carousel-thumb' role='button' data-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Previous</span>
                    </a>
                    <a class='carousel-control-next' href='#carousel-thumb' role='button' data-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Next</span>
                    </a>
                </div><br><br>
                <h2>$titre</h2><br><br>

                <div class='container'>
                    <div class='row'>
                        <div class='col-8'>
                            <h4>DESCRIPTION</h4><br>
                            <h6>Catégorie : $categorie <br>
                            Type de Vente : $type</h6><br>
                            $description
                        </div>
                        <div class='col-4'>
                        <h4>Enchérir</h4>
                            <form action='article.php?id=$id' method='post'>
                            <input type='texte' name='prix_donne' placeholder='Supérieur à $prix €'><br>
                                <br><button name='encherir' class='btn btn-primary'>Valider l'enchère</button>
                            </form>
                        </div>
                    </div>
                </div>
                </center>";
            }
            else if($type == "Meilleure Offre")
            {
                $str = "
            
                <center>
                <div id='carousel-thumb' class='carousel slide carousel-fade carousel-thumbnails' data-ride='carousel'>
                    <!--Slides-->
                    <div class='carousel-inner' role='listbox'>
                        <div class='carousel-item active'>
                        <img class='d-block w-50' src='$image1'
                            alt='First slide'>
                        </div>
                        <div class='carousel-item'>
                        <img class='d-block w-50' src='$image2'
                            alt='Second slide'>
                        </div>
                        <div class='carousel-item'>
                        <img class='d-block w-50' src='$image3'
                            alt='Third slide'>
                        </div>
                        
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class='carousel-control-prev' href='#carousel-thumb' role='button' data-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Previous</span>
                    </a>
                    <a class='carousel-control-next' href='#carousel-thumb' role='button' data-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Next</span>
                    </a>
                </div><br><br>
                <h2>$titre</h2><br><br>

                <div class='container'>
                    <div class='row'>
                        <div class='col-8'>
                            <h4>DESCRIPTION</h4><br>
                            <h6>Catégorie : $categorie <br>
                            Type de Vente : $type</h6><br>
                            $description
                        </div>
                        <div class='col-4'>
                            <h4>$prix €</h4>
                            <form action='negociation.php?id=$id' method='post'>
                                <input type='number' name='offre_montant'><br><br>
                                <button name='demander_offre' class='btn btn-primary'>Demander un Offre</button>
                            </form>
                        </div>
                    </div>
                </div>

                </center>";
            }

        }
    }
    else
    {
        header("Location: index.php");
    }

    echo $str;
    
    if(isset($_POST['ajouter_panier']))
    {
        if(logged_in())
        {
            $email = $_SESSION['email'];
            $sql =  mysqli_query($con, "INSERT INTO panier (user, titre, prix, photo, type) VALUES ('$email', '$titre', '$price', '$image1', '$type')");
        }
        else
        {
            redirect("login.php");
        }
        
    }  
    
    if(isset($_POST['encherir']))
    {
        if(logged_in())
        {
            $prix_donne = $_POST['prix_donne'];
            if ($prix_donne > $prix2) {
                $email = $_SESSION['email'];
                if ($prix_donne > $prix1) {
                    $sql1 =  mysqli_query($con, " UPDATE `item` SET `prix1` = '$prix_donne', `prix2` = '$prix1', `mail_client` = '$email' WHERE `item`.`ID` = $id;");
                    $sql2 =  mysqli_query($con, "INSERT INTO panier (user, titre, prix, photo, type) VALUES ('$email', '$titre', '$prix_donne', '$image1', '$type')");
                }
                else {
                    $sql1 =  mysqli_query($con, " UPDATE `item` SET `prix2` = '$prix_donne' WHERE `item`.`ID` = $id;");
                    $sql2 =  mysqli_query($con, "INSERT INTO panier (user, titre, prix, photo, type) VALUES ('$email', '$titre', '$price', '$image1', '$type')");
                }
            }
            else {
                $sql2 =  mysqli_query($con, "INSERT INTO panier (user, titre, prix, photo, type) VALUES ('$email', '$titre', '$prix_donne', '$image1', '$type')");
            }


        }
        else
        {
            redirect("login.php");
        }
        
    }

    if(isset($_POST['demander_offre']))
    {
        if(logged_in())
        {
            $montant = $_POST['offre_montant'];
            $email = $_SESSION['email'];

            if($montant > 0 && $montant <= $price)
            {
                if($offre < 5)
                {
                    $offre = $offre + 1;
                    $sql = mysqli_query($con, "UPDATE item SET Offre='$offre', prix2='$montant', mail_client='$email' WHERE ID ='$id'");
                    $sql1 =  mysqli_query($con, "INSERT INTO panier (user, titre, prix, photo, type) VALUES ('$email', '$titre', '$price', '$image1', '$type')");
                }
                else
                {
                    $sql = mysqli_query($con, "UPDATE item SET Vendu='1' WHERE ID ='$id'");
                }
            }
            else
            {
                set_message("<div class='alert alert-warning'>Veuillez choisir un prix entre 0 € et $prix €</div>");
            }


        }
        else
        {
            redirect("login.php");
        }
        
    }
        
}


function display_item($con, $sql)
{

    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $titre = $row['Nom'];
            $image1 = $row['Image1'];
            $image2 = $row['Image2'];
            $image3 = $row['Image3'];
            $price = $row['Prix'];
            $prix = number_format($price, 2, ',', ' ');
            $type = $row['typeVente'];
            $categorie = $row['Categorie'];
            $description = $row['Description'];
                    

            $str .= "<center>
                <div class='container'>
                    <div class='row'>
                        <div class='col-2'>
                        </div>
                        <div class='col-8'>
                        <div class='card text-center'>
                            <div class='card-header'>
                                <a href='article.php?id=$id'>
                                <h5>$titre &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $prix €</h5>
                                </div>
                                <div class='card-body'>
                                    <img src='$image1' class='img1'></a>
                                </div>
                                <div class='card-footer text-muted'>
                                    Catégorie : $categorie &nbsp&nbsp&nbsp Type de Vente : $type
                                </div>
                            </div>
               
                        </div>
                        <div class='col-2'>
                        </div>
                    </div>
                </div>

                </center>    ";

            
            }
    }

    echo $str;
}

function panier_item($con, $sql)
{
    $email = $_SESSION['email'];
    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['id'];
            $titre = $row['titre'];
            $image1 = $row['photo'];
            $price = $row['prix'];
            $prix = number_format($price, 2, ',', ' ');
            $user = $row['user'];    
            $type = $row['type'];  

            $str .= "<center>
            <div class='container'>
                <div class='row'>
                    <div class='col-2'>
                    </div>
                    <div class='col-8'>
                    <div class='card text-center'>
                        <div class='card-header'>
                        <h5>$titre &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $prix €</h5>
                            </div>
                            <div class='card-body'>
                                <img src='$image1' class='img1'>
                            </div>
                            <div class='card-footer text-muted'>
                            <form class='settings_form' action='panier.php' method='POST'>
                                <button class='btn btn-danger' name='supprimer_panier'>Supprimer</button>
                            </form>
                            </div>
                        </div>
           
                    </div> 
                    <div class='col-2'>
                    </div>
                </div>
            </div>
                    
            </center>    ";
            
            
            if(isset($_POST['supprimer_panier']))
            {
                $sql = mysqli_query($con, "DELETE FROM panier WHERE id = '$id'");
                            
            } 
            

        }
    }

    echo $str;

    
}



function negocier_item($con, $sql)
{

    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $titre = $row['Nom'];
            $image1 = $row['Image1'];
            $image2 = $row['Image2'];
            $image3 = $row['Image3'];
            $price = $row['Prix'];
            $prix = number_format($price, 2, ',', ' ');
            $type = $row['typeVente'];
            $categorie = $row['Categorie'];
            $description = $row['Description'];
                    
            
            $str .= "<center>
                <div class='container'>
                    <div class='row'>
                        <div class='col-2'>
                        </div>
                        <div class='col-8'>
                        <div class='card text-center'>
                            <div class='card-header'>
                                <a href='negociation.php?id=$id'>
                                <h5>$titre &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $prix €</h5>
                                </div>
                                <div class='card-body'>
                                    <img src='$image1' class='img1'></a>
                                </div>
                                <div class='card-footer text-muted'>
                                    Catégorie : $categorie &nbsp&nbsp&nbsp Type de Vente : $type
                                </div>
                            </div>
               
                        </div> 
                        <div class='col-2'>
                        </div>
                    </div>
                </div>

                </center>    "; 

            
            }
    }

    echo $str;
}

function affichage_vendeur($con, $sql)
{

    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $pseudo = $row['Pseudo'];
            $photo = $row['Photo'];
            $email = $row['Mail'];
            $nom = $row['Nom'];
            $fond = $row['Fond'];
                    

            $str .= "<center>
            <a href='modifierVendeurBis.php?id_vendeur=$id'>
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='$photo' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-text' color:'grey'>$nom</h5>
                    <h6 class='card-text' color:'grey'>@$pseudo</h6>
                </div>
            </div></a>
              
            <hr>    
                
            </center>    ";

            
            }
    }

    echo $str;
}

function affichage_item($con, $sql)
{

    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $titre = $row['Nom'];
            $image1 = $row['Image1'];
            $image2 = $row['Image2'];
            $image3 = $row['Image3'];
            $price = $row['Prix'];
            $prix = number_format($price, 2, ',', ' ');
            $type = $row['typeVente'];
            $categorie = $row['Categorie'];
            $description = $row['Description'];
                    
            
            $str .= "<center>
                <div class='container'>
                    <div class='row'>
                        <div class='col-2'>
                        </div>
                        <div class='col-8'>
                        <div class='card text-center'>
                            <div class='card-header'>
                                <a href='modifierItemBis.php?id_item=$id'>
                                <h5>$titre &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $prix €</h5>
                                </div>
                                <div class='card-body'>
                                    <img src='$image1' class='img1'></a>
                                </div>
                                <div class='card-footer text-muted'>
                                    Catégorie : $categorie &nbsp&nbsp&nbsp Type de Vente : $type
                                </div>
                            </div>
               
                        </div> 
                        <div class='col-2'>
                        </div>
                    </div>
                </div>

                </center>    "; 

            
            }
    }

    echo $str;
}

function index_item($con, $sql)
{

    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $titre = $row['Nom'];
            $image1 = $row['Image1'];
            $price = $row['Prix'];
            $prix = number_format($price, 2, ',', ' ');
            $type = $row['typeVente'];
                    

                $str .= "
                        <div class='card' style='width: 16rem;'>
                            <a href='article.php?id=$id'>
                                <img class='card-img-top' src='$image1' alt='Image'>
                                <div class='card-body'>
                                <center><h6 class='card-text'>$titre
                                <br>$prix €</h6></center>
                                </div>
                            </a>
                        </div>

                ";
                

            
            }
    }

    echo $str;
}

function compte_item($con, $sql)
{

    $str = "";

    $data_query = mysqli_query($con, $sql);

    if(mysqli_num_rows($data_query) > 0)
    {

        while($row = mysqli_fetch_array($data_query))
        {
            $id = $row['ID'];
            $titre = $row['Nom'];
            $image1 = $row['Image1'];
            $price = $row['Prix'];
            $prix = number_format($price, 2, ',', ' ');
            $type = $row['typeVente'];
                    

                $str .= "
                        <div class='card' style='width: 13rem;'>
                                <img class='card-img-top' src='$image1' alt='Image'>
                                <div class='card-body'>
                                <center><h6 class='card-text'>$titre
                                <br>$prix €</h6></center>
                                </div>
                        </div>

                ";
                

            
            }
    }

    echo $str;
}


?>
