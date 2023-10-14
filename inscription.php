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
/*
$bdd = new PDO("", "", "");
$req = $bdd->prepare("INSERT INTO utilisateur(nom,prenom,username,email,date_de_naissance,mot_de_passe) VALUES (?,?,?,?,?,?);");

if($_POST) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $date_naissance = $_POST['date_de_naissance'];
    $password = $_POST['mot_de_passe'];


    $req->execute([$nom, $prenom, $username, $email, $date_naissance, $password]);

    header('Location: home.php');
}*/
?>
    <div class="form-container">
        <h1>Bienvenue sur WOOLIFY</h1>
        <form action="home.php" method="post" onsubmit="return CheckLoginForm()">
            <div class="modal">
                <div class="modal-content">
                    <input type="text" id="nom" name="nom" placeholder="Nom" required>
                    <input type="text" id="prenom" name="prenom" placeholder="Prenom" required>
                    <input type="text" id="username" name="username" placeholder="Pseudo" required>
                    <input type="text" id="email" name="email" placeholder="E-mail" required>
                    <input type="date" id="date_naissance" name="date_naissance" placeholder="Date de naissane" required>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmer Mot de passe" required>
                    <button type="submit"><span>Inscription</span></button>
                </div>
            </div>
        </form>
    </div>

    <script> 

    function CheckLoginForm(){
		var password = document.getElementById("password").value;
		var confirm_password = document.getElementById("confirm_password").value;
		var age = document.getElementById("date_naissance").value;
		var today = new Date();
		var email = document.getElementById("email").value;
		var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	
		if(password.length < 6){
			alert("Les noms mots de passe de moins de 4 lettres ne sont pas autorisés!")
			return false;
		}else if(password !== confirm_password){
			alert("Le mot de passe doit etre le même")
			return false;
		}else if (age < 16) {
			alert("Vous devez avoir au moins 16 ans pour vous inscrire.");
			return false;
		}else if (!email.match(emailPattern)) {
			alert("Veuillez entrer une adresse email valide.");
			return false;
		}else{
			return true;
		}
	}
    </script>
</body>
</html>
