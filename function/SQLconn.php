<?php
require_once (__ROOT__."/function/loginStatus.php");

class SQLconn{
    //Attributs de la class
    //--------------------------------------------------------------------------------
    public $conn = NULL;
    public $loginStatus = NULL;

    //Construction de la class
    //--------------------------------------------------------------------------------
    //fonction connection à la bdd
    function __construct() {
        //Créer connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hublart_benzzine";
        
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ( $this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Après connection, créer l'objet loginstatus
        $this->loginStatus = new LoginStatus($this);
    }

    //Fonction pour sécuriser les données utilisateur de manière basique
    //--------------------------------------------------------------------------------
    function SecurizeString_ForSQL($string) {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = addslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    //Fonction pour traiter un formulaire de création de compte
    //--------------------------------------------------------------------------------
    function Process_NewAccount_Form(){
        $creationAttempted = false;
        $creationSuccessful = false;
        $error = NULL;
        //Données reçues via formulaire
        if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["pseudo"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["email"]) && isset($_POST["date_naissance"] )){
            $creationAttempted = true;
            
            $userNom = $this->SecurizeString_ForSQL($_POST["nom"]);
            $userPrenom = $this->SecurizeString_ForSQL($_POST["prenom"]);
            $userPseudo = $this->SecurizeString_ForSQL($_POST["pseudo"]);
            $password = md5($_POST["password"]);
            $userEmail = $this->SecurizeString_ForSQL($_POST["email"]);
            $userDateNaissance = $this->SecurizeString_ForSQL($_POST["date_naissance"]);           
            
            //Verifier s l'email n'est pas deja utilise si oui afficher un message d'erreur sinon insert le nouvel utilisateur 
            $chekEmailQuery = "SELECT * FROM utilisateur WHERE email = '".$userEmail."'";
            $emailCheckResult  = $this->conn->query($chekEmailQuery);

            if ( $emailCheckResult->num_rows != 0 ){
                $error = "Cette adresse email est déjà utilisée.";
            }else{
                //insertion des information du nouvelle utilisateur
                $insertQuery = "INSERT INTO utilisateur(idUtilisateur, nom, prenom, pseudo, password, email, dateNaissance, role)
                VALUES (NULL,  '$userNom', '$userPrenom',  '$userPseudo', '$password', '$userEmail', '$userDateNaissance', default)";
                $result = $this->conn->query($insertQuery);

                if( mysqli_affected_rows($this->conn) == 0 )
                {
                    $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
                }else{
                    $creationSuccessful = true;
                    $this->loginStatus->CreateLoginCookie($userEmail, $password);
                }
            }
        }
		//On crée un tableau associatif contenant les informations à retourner
		$returnArray = ['attempted' => $creationAttempted, 
						'success' => $creationSuccessful, 
						'error' => $error ];
    
        return $returnArray;
    }

    //Proxy qui appelle query sur conn. Juste là pour le confort
	//--------------------------------------------------------------------------------
	function query($stringQuery){
		return $this->conn->query($stringQuery);
	}

    //Fonction pour fermer la connection sur base de données
    //--------------------------------------------------------------------------------
    function DisconnectDatabase(){
        $this->conn->close();
    }
}

?>