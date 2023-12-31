<?php
   //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
    include('navbar.php');

    //Sur cette page, on doit lancer la fonction qui s'occupe de gérer la
    //réception d'un formulaire de création de compte
    $newAccountStatus = $SQLconn->Process_NewAccount_Form();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/inscription.css">
    <title>Inscription</title>
</head>
<body> 
<?php
    if($newAccountStatus["success"]){
        echo '<h3 class="successMessage">Nouveau compte crée avec succès!</h3>';
    }
    elseif ($newAccountStatus["attempted"]){
        echo '<h3 class="errorMessage">'.$newAccountStatus["error"].'</h3>';
    }
?>
    
    <div class="form-container">
        <form action="inscription.php" method="post" onsubmit="return CheckLoginForm()">
            <div class="modal2">
                <div class="modal-content">
                    <h3>Information Personnelle</h3>
                    <input type="text" id="nom" name="nom" placeholder="Nom" required>
                    <input type="text" id="prenom" name="prenom" placeholder="Prenom" required>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required>
                    <input type="text" id="mel" name="mel" placeholder="E-mail" required>
                    <input type="date" id="date_naissance" name="date_naissance" placeholder="Date de naissane" required>
                    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmer Mot de passe" required>
                    <h3>Adresse de livraison</h3>
                    <input type="text" id="adresse" name="adresse" placeholder="Adresse" required>
                    <input type="text" id="CP" name="CP" placeholder="Code Postal" required>
                    <input type="text" id="ville" name="ville" placeholder="Ville" required>
                    <input type="text" id="pays" name="pays" placeholder="Pays" required>
                    <button type="submit"><span>Inscription</span></button>
                </div>
            </div>
        </form>
    </div>
    <div class="footer">
        <?php 
            include('footer.php'); 
            //Déconnection de la BDD en fin de page (plus propre)
            $SQLconn->DisconnectDatabase();
        ?>
    </div>
    <script> 
        //----------------------------------------------------------------------------
        function checkEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
         }
        //Fonction pour vérifier que le formulaire d'inscription est correctement rempli
        function CheckLoginForm(){
            var password = document.getElementById("mdp").value;
            var confirm_password = document.getElementById("confirm_password").value;
            var birthdate = new Date(document.getElementById("date_naissance").value);
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var email = document.getElementById("mel").value;


            if (checkEmail(email) == false) {
                alert("Veuillez entrer une adresse email valide.");
                return false;
            }
            else if(password.length < 6){
                alert("Les mots de passe de moins de 6 lettres ne sont pas autorisés!")
                return false;
            }
            else if(password !== confirm_password){
                alert("Le mot de passe doit etre le même")
                return false;
            }
            else if (age < 18) {
                alert("Vous devez avoir au moins 18 ans pour vous inscrire.");
                return false;
            }else{
                return true;
            }
        }
        //----------------------------------------------------------------------------
    </script>
</body>
</html>
