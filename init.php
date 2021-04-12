<?php ob_start();

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("db.php");
include("fonctions.php");
include("fonctions_admin.php");
include("fonctions_vendeur.php");
include("item.php");


?>