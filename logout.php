<?php
//Initialise la constante ROOT et $SQLconn pour la BDD
include("./initialize.php");

if(isset($_SESSION['panier'])){
    deleteCart();
}

//Si on a bien reçu une valeur dans $_POST["logout"], on se déconnecte
if (isset($_POST["logout"])){
    $SQLconn->loginStatus->Logout();
}

//En PHP, on peut détruire une variable avec unset
unset($_POST);

//Redirection vers la page acceuil
$redirect = "Location:./home.php";
header($redirect);

?>