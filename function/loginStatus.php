<?php
class LoginStatus{
	//Attributs de la classe
	//--------------------------------------------------------------------------------
    public $loginSuccessful = false;
    public $loginAttempted = false;
    public $errorText = "";
    public $userID = 0;
    public $userEmail = "";
    
    // Constructeur de la classe
    //-------------------------------------------------------------------------------------
    function __construct(&$SQLconn) {
        $this->loginSuccessful = false;

        //Données reçues via formulaire
        if(isset($_POST["email"]) && isset($_POST["password"])){
            $this->userEmail = $SQLconn->SecurizeString_ForSQL($_POST["email"]);
            $password = md5($_POST["password"]);
            $this->loginAttempted = true;
        }
        //Données via le cookie
        elseif ( isset( $_COOKIE["email"] ) && isset( $_COOKIE["password"] ) ) {
            $this->userEmail = $_COOKIE["email"];
            $password = $_COOKIE["password"];
            $this->loginAttempted = true;
        }
        else {
            $this->loginAttempted = false;
        }

        //Si un login a été tenté, on interroge la BDD
        if ( $this->loginAttempted ){

            $query = "SELECT * FROM utilisateur WHERE email = '".$this->userEmail."' AND mdp ='".$password."'";
            $result = $SQLconn->conn->query($query);
            if ( $result->num_rows != 0 ){
                $row = $result->fetch_assoc();
                $this->userID = $row["idUtilisateur"];
                $this->userEmail = $row["email"];
                $this->CreateLoginCookie($this->userEmail, $password);
                $this->loginAttempted = false;
                $this->loginSuccessful = true;
            }
            else {
                $this->errorText = "Cette utilisateur n'existe pas ou le mot de passe est incorrect.";
            }
        }
    }
    
      
    // Méthode pour stocker un login réussi dans un cookie pour 24h
    //-------------------------------------------------------------------------------------
    function CreateLoginCookie($userEmail, $encryptedPasswd){
        setcookie("email", $userEmail, time() + 24*3600 );
        setcookie("password", $encryptedPasswd, time() + 24*3600);
    }
    // Méthode pour se délogger. Détruit le cookie.
    //-------------------------------------------------------------------------------------
    function Logout(){
        setcookie("email", NULL, -1 );
        setcookie("password", NULL, -1);
    }
} // Fin de classe
?>
