<?php
	//Definit une constante avec le chemin du sous-dossier du site
	//On s'en servira pour construire des chemins de fichier
    define('__ROOT__', dirname(dirname(__FILE__))."/PROJET_WEB");
	
	//Inclusion du fichier avec la classe SQLconn
    require_once(__ROOT__."/function/SQLconn.php");
	
	//Création d'une instance de SQLconn
    $SQLconn = new SQLconn();
?>