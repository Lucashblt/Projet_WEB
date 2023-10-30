<?php
    include("./initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="./styles/MonCompte.css">
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <div class="form-container">
        <form>
            <div class="modal2">
                <div class="modal-content">
                    <h3>Information Personnelle</h3>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="Nom" disabled>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="Prénom" disabled>
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" value="Pseudo" disabled>
                    <label for="mel">E-Mail :</label>
                    <input type="text" id="mel" name="mel" value="E-mail" disabled>
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="Date de naissance" disabled>
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" value="Mot de passe" disabled>
                    <h3>Adresse de livraison</h3>
                    <label for="adresse">Adresse :</label>
                    <input type="text" id="adresse" name="adresse" value="Adresse" disabled>
                    <label for="cp">Code Postale :</label>
                    <input type="text" id="cp" name="cp" value="Code Postale" disabled>
                    <label for="ville">Ville :</label>
                    <input type="text" id="ville" name="ville" value="Ville" disabled>
                    <label for="pays">Pays :</label>
                    <input type="text" id="pays" name="pays" value="Pays" disabled>
                    <button id="edit-info-btn">Modifier</button>
                    <button id="save-info-btn" style="display: none;" onclick="return CheckLoginForm()">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>

        <div class="previous-orders">
            <h2>Commandes Précédentes</h2>
            <button id="show-orders-btn">Afficher les commandes</button>
            <ul id="orders-list" style="display: none;">
                <!-- Les commandes précédentes de l'utilisateur seront affichées ici -->
            </ul>
        </div>
    </div>

    <?php
        include('footer.html');
    ?>

    <script>
        function checkEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
         }
        function CheckLoginForm(){
            var password = document.getElementById("mdp").value;
            var birthdate = new Date(document.getElementById("date_naissance").value);
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var email = document.getElementById("mel").value;

            if (age < 18) {
                alert("Vous devez avoir au moins 18 ans pour vous inscrire.");
                return false;
            }else if (checkEmail(email) == false) {
                alert("Veuillez entrer une adresse email valide.");
                return false;
            }
            else if(password.length < 6){
                alert("Les mots de passe de moins de 6 lettres ne sont pas autorisés!")
                return false;
            }else{
                return true;
            }
        }
        const editInfoButton = document.getElementById('edit-info-btn');
        const saveInfoButton = document.getElementById('save-info-btn');
        const inputs = document.querySelectorAll('.modal-content input');

        // Écouteur d'événement pour activer l'édition des informations
        editInfoButton.addEventListener('click', () => {
            inputs.forEach(input => {
                input.removeAttribute('disabled');
            });
            editInfoButton.style.display = 'none';
            saveInfoButton.style.display = 'block';
        });

        // Écouteur d'événement pour enregistrer les modifications des informations
        saveInfoButton.addEventListener('click', () => {
            const updatedInfo = {};

            inputs.forEach(input => {
                const name = input.getAttribute('name');
                updatedInfo[name] = input.value;
                input.setAttribute('disabled', true);
            });

            // Envoyer les modifications au backend pour mise à jour dans la base de données
            editInfoButton.style.display = 'block';
            saveInfoButton.style.display = 'none';
        })

        // Écouteur d'événement pour afficher les commandes précédentes
        showOrdersButton.addEventListener('click', () => {
            // Récupérer les commandes précédentes de l'utilisateur depuis le backend et afficher la liste
            ordersList.style.display = 'block';
            showOrdersButton.style.display = 'none';
        });
    </script>
</body>
</html>