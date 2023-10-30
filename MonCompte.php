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
        <form action="#" method="post">
            <div class="modal2">
                <div class="modal-content">
                    <h3>Information Personnelle</h3>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="Nom" disabled>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="Prénom" disabled>
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" value="Pseudo" disabled>
                    <label for="email">E-Mail :</label>
                    <input type="text" id="email" name="email" value="Email" disabled>
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
                    <button id="save-info-btn" style="display: none;">Enregistrer</button>
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
        const editInfoButton = document.getElementById('edit-info-btn');
        const saveInfoButton = document.getElementById('save-info-btn');
        const ordersList = document.getElementById('orders-list');
        const showOrdersButton = document.getElementById('show-orders-btn');

        // Écouteur d'événement pour activer l'édition des informations
        editInfoButton.addEventListener('click', () => {
            document.getElementById('nom').removeAttribute('disabled');
            document.getElementById('email').removeAttribute('disabled');
            editInfoButton.style.display = 'none';
            saveInfoButton.style.display = 'block';
        });

        // Écouteur d'événement pour enregistrer les modifications des informations
        saveInfoButton.addEventListener('click', () => {
            const updatedNom = document.getElementById('nom').value;
            const updatedEmail = document.getElementById('email').value;

            // Envoyer les modifications au backend pour mise à jour dans la base de données

            document.getElementById('nom').setAttribute('disabled', true);
            document.getElementById('email').setAttribute('disabled', true);
            editInfoButton.style.display = 'block';
            saveInfoButton.style.display = 'none';
        });

        // Écouteur d'événement pour afficher les commandes précédentes
        showOrdersButton.addEventListener('click', () => {
            // Récupérer les commandes précédentes de l'utilisateur depuis le backend et afficher la liste
            ordersList.style.display = 'block';
            showOrdersButton.style.display = 'none';
        });
    </script>
</body>
</html>