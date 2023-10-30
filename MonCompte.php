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
    <div class="account">
        <div class="account-info">
            <h2>Informations de l'utilisateur</h2>
            <form>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="Nom de l'utilisateur" disabled>
                <label for="email">Adresse Email :</label>
                <input type="email" id="email" name="email" value="email@utilisateur.com" disabled>
                <button id="edit-info-btn">Modifier</button>
                <button id="save-info-btn" style="display: none;">Enregistrer</button>
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