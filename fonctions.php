<?php

function clean($string)
{
    return htmlentities($string);
}

function redirect($location)
{
    return header("Location: {$location} ");
}

function set_message($message)
{
    if(!empty($message))
    {
        $_SESSION['message'] = $message;
    }
    else
    {
        $message = "";
    }
}

function display_message()
{
    if(isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator()
{
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
}


function email_exists($email)
{
    $sql = "SELECT id FROM acheteur WHERE email = '$email'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}


function send_mail($email, $subject, $message, $headers)
{
    return mail($email, $subject, $message, $headers);
}


function validate_user_registration()
{
    $errors = [];

    $min = 5;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        $address1 = clean($_POST['address1']);
        $address2 = clean($_POST['address2']);
        $zip = clean($_POST['zip']);
        $city = clean($_POST['city']);
        $country = clean($_POST['country']);
        $tel = clean($_POST['tel']);
    }

    if(isset($_POST['register-submit']))
    {
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['address1'] = $address1;
        $_SESSION['address2'] = $address2;
        $_SESSION['zip'] = $zip;
        $_SESSION['city'] = $city;
        $_SESSION['country'] = $country;
        $_SESSION['tel'] = $tel;

        if(email_exists($email))
        {
            $errors[] = "Sorry, that email is already registered";
        }

        if(strlen($password) < $min)
        {
            $errors[] = "Your Password cannot be less than {$min} characters";
        }

        if($password !== $confirm_password)
        {
            $errors[] = "Your password fields do not match";
        }

        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo "";
            }
        }
        else
        {
            if(register_user($first_name, $last_name, $email, $password, $address1, $address2, $zip, $city, $country, $tel))
            {
                set_message("<div class='alert alert-success' role='alert'>
                Un lien d'activation de votre compte à été envoyé dans votre boîte mail !
                </div>");

                redirect("message.php");


            }
            else
            {
                set_message("<div class='alert alert-danger' role='alert'>
                    Désolé, on ne peut pas inscrire cet utilisateur !
                  </div>");

                redirect("message.php");
            }

        }
    }

}



function register_user($first_name, $last_name, $email, $password, $address1, $address2, $zip, $city, $country, $tel)
{
    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $email = escape($email);
    $password= escape($password);
    $address1= escape($address1);
    $address2= escape($address2);
    $zip= escape($zip);
    $city= escape($city);
    $country= escape($country);
    $tel= escape($tel);



    if(email_exists($email))
    {
        return false;
    }
    else
    {
        $password = md5($password);

        $validation_code = md5($email + microtime());
        $profile_pic = "uploads/profile_random.png";
        $photo_status = "1";

        $sql = "INSERT INTO acheteur (first_name, last_name, email, password, validation_code, active, Adresse1, Adresse2, Ville, CodePostal, Pays, Telephone)";
        $sql.= " VALUES('$first_name','$last_name','$email','$password', '$validation_code', 0, '$address1', '$address2', '$city', '$zip', '$country', '$tel')";
        $result = query($sql);

        $subject = "Activate account";
        $message = " Please click the link below to activate your Account
        
        http://localhost/ing3/ebay/activate.php?email=$email&code=$validation_code
        ";

        $headers = "From: noreply@ebay-ece.com";


        send_mail($email, $subject, $message, $headers);

        return true;


    }

    
}



function activate_user()
{
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET['email']))
        {
            $email = clean($_GET['email']);
            $validation_code = clean($_GET['code']);

            $sql = "SELECT id FROM acheteur WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";
            $result = query($sql);


            if(row_count($result) == 1)
            {
                $sql2 = "UPDATE acheteur SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";
                $result2 = query($sql2);
                confirm($result2);

                set_message("<div class='alert alert-success' role='alert'>
                    Votre compte est activé. Veuillez-vous connecter !
                  </div>");

                redirect("login.php");
            }
            else
            {
                set_message("<div class='alert alert-danger' role='alert'>
                    Désolé, votre compte ne peut pas être activé !
                  </div>");

                redirect("index.php");
            }
        }

    }
}

function validate_user_login()
{
    $errors = [];
    $min = 5;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $remember = isset($_POST['remember']);


        if(empty($email))
        {
            $errors[] = "email field cannot be empty";
        }

        if(empty($password))
        {
            $errors[] = "Password field cannot be empty";
        }


        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo "";
            }
        }
        else
        {
            if(login_user($email, $password, $remember))
            {
                redirect("compte.php");
            }
            else
            {
                set_message("<div class='alert alert-danger' role='alert'> Vos identifiants sont incorrectes !
              </div>");
            }
        } 
    }

}


function login_user($email, $password, $remember)
{
    $sql = "SELECT password, id FROM acheteur WHERE email = '".escape($email)."' AND active = 1";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        $row = fetch_array($result);
        $db_password = $row['password'];

        if(md5($password) === $db_password)
        {
            if($remember == "on")
            {
                setcookie('email', $email, time() + 86400);
            }

            $_SESSION['email'] = $email;

            return true;
        }
        else
        {
            return false;
        }

        return true;
    }
    else
    {
        return false;
    }



}


function logged_in()
{
    if(isset($_SESSION['email']) || isset($_COOKIE['email']))
    {
        return true;
	}
	else
	{
		return false;
	}

}

function validate_user_login_admin()
{
    $errors = [];
    $min = 5;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email_admin = clean($_POST['email_admin']);
        $password_admin = clean($_POST['password_admin']);


        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo validation_errors($error);
            }
        }
        else
        {
            if(login_user_admin($email_admin, $password_admin))
            {
                redirect("admin.php");
            }
            else
            {
                set_message("<div class='alert alert-danger' role='alert'>
                Vos identifiants ne sont pas correctes !
                </div>");
            }
        } 
    }

}

function login_user_admin($email_admin, $password_admin)
{
    $sql = "SELECT * FROM admin WHERE login = '".escape($email_admin)."'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        $row = fetch_array($result);
        $db_password_admin = $row['password'];

        if($password_admin === $db_password_admin)
        {

            $_SESSION['login'] = $email_admin;

            return true;
        }
        else
        {
            return false;
        }

        return true;
    }
    else
    {
        return false;
    }



}


function logged_in_admin()
{
    if(isset($_SESSION['login']) || isset($_COOKIE['login']))
    {
        return true;
	}
	else
	{
		return false;
	}

}


function recover_password()
{
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token'])
        {
            $email = clean($_POST['email']);

            if(email_exists($email))
            {
                $validation_code = md5($email + microtime());

                setcookie('temp_access_code', $validation_code, time() + 900);

                $sql = "UPDATE acheteur SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
                $result = query($sql);

                $subject = "Please reset your Password";
                $message = " Here is your password reset code {$validation_code};

                Click here to reset your password

                http://localhost/ing3/ebay/code.php?email=$email&code=$validation_code
                
                
                
                ";

                $headers = "From: noreply@yourwebsite.com";

                if(!send_mail($email, $subject, $message, $headers))
                {
                    set_message("<div class='alert alert-danger' role='alert'>
                    Mail n'a pas pu être envoyé !
                    </div>");
                }

                set_message("<div class='alert alert-success' role='alert'>
                Un mail de réinitialisation de votre mot de passe a été envoyé dans votre boîte mail !
                </div>");

                redirect("message.php");

            }
            else
            {
                set_message("<div class='alert alert-danger' role='alert'> Adresse mail n'existe pas !
                </div>");
            }
        }
        else
        {
            redirect("index.php");
        } 

        
    }
    if(isset($_POST['cancel_submit']))
    {
        redirect("login.php");
    }
}


function validate_code()
{
    if(isset($_COOKIE['temp_access_code']))
    {
        if(!isset($_GET['email']) && !isset($_GET['code']))
        {
            redirect("index.php");
        }
        else if(empty($_GET['email']) || empty($_GET['code']))
        {
            redirect("index.php");
        }
        else
        {
            if(isset($_POST['code']))
            {
                $email = clean($_GET['email']);

                $validation_code = clean($_POST['code']);

                $sql = "SELECT id FROM acheteur WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."'";
                $result = query($sql);

                if(row_count($result) == 1)
                {
                    setcookie('temp_access_code', $validation_code, time() + 300);
                    redirect("reset.php?email=$email&code=$validation_code");
                }
                else
                {
                    set_message("<div class='alert alert-danger' role='alert'>
                    Code de validation est faux !
                  </div>");
                }
            }
        }
    }
    else
    {
        set_message("<div class='alert alert-danger' role='alert'>
        Désolé, votre validation de cookie est expiré
        </div>");

        redirect("recover.php");
    }
}

function password_reset()
{
    if(isset($_COOKIE['temp_access_code']))
    {
        if(isset($_GET['email']) && isset($_GET['code']))
        {
            if(isset($_SESSION['token']) && isset($_POST['token']) && $_POST['token'] === $_SESSION['token'])
            {
                if($_POST['password'] === $_POST['confirm_password'])
                {
                    $updated_password = md5($_POST['password']);

                    $sql = "UPDATE acheteur SET password = '".escape($updated_password)."', validation_code = 0 WHERE email = '".escape($_GET['email'])."'";
                    query($sql);

                    set_message("<div class='alert alert-success' role='alert'>
                    Votre mot de passe est mise à jour, veuillez-vous connecter !
                    </div>");
                    redirect("login.php");
                }    
            }

        }
    
    }
    else
    {
        set_message("<div class='alert alert-danger' role='alert'>Désolé, votre temps est expiré !
        </div>");
        redirect("recover.php");
    }
}


// -----------------------------------------------------------------------
// -----------------------------------------------------------------------



function validate_user_login_vendeur()
{
    $errors = [];
    $min = 5;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pseudo_vendeur = clean($_POST['pseudo_vendeur']);
        $password_vendeur = clean($_POST['password_vendeur']);


        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo validation_errors($error);
            }
        }
        else
        {
            if(login_user_vendeur($pseudo_vendeur, $password_vendeur))
            {
                redirect("vendeur.php");
            }
            else
            {
                set_message("<div class='alert alert-danger' role='alert'>
                Vos identifiants ne sont pas correctes !
                </div>");
            }
        } 
    }

}

function login_user_vendeur($pseudo_vendeur, $password_vendeur)
{
    $sql = "SELECT * FROM vendeur WHERE Pseudo = '".escape($pseudo_vendeur)."'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        $row = fetch_array($result);
        $db_password_vendeur = $row['Password'];

        if($password_vendeur === $db_password_vendeur)
        {

            $_SESSION['Pseudo'] = $pseudo_vendeur;

            return true;
        }
        else
        {
            return false;
        }

        return true;
    }
    else
    {
        return false;
    }



}


function logged_in_vendeur()
{
    if(isset($_SESSION['Pseudo']) || isset($_COOKIE['Pseudo']))
    {
        return true;
    }
    else
    {
        return false;
    }

}


function email_vendeur_exists($email)
{
    $sql = "SELECT ID FROM vendeur WHERE Mail = '$email'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}














?>