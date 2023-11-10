<?php
    include "../initialize.php";
    include "../backend/functioncatalogue.php";


    $loggedIn = false;

    if ($SQLconn->loginStatus->loginSuccessful) {
        $loggedIn = true;
        
        $query ="SELECT role from utilisateur where email ='" . $SQLconn->loginStatus->userEmail . "'";
        $result = $SQLconn->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row["role"];
            if ($role == "Client") {  
                $redirect = "Location:../home.php";
                header($redirect);
            } else {
                $redirect = "Location:../backend/index.php";
            }
            
        }
    } else {
        $loggedIn = false;
    }
    
    //suprimer categorie
    if (isset($_POST["delete"])) {
        // Récupérez l'idCategorie à partir du formulaire
        $idCategorie = $_POST["idCategorie"];
        deleteCategorie($idCategorie);

    }

    if (isset($_POST['edit'])) {
        // Récupérez l'id de la catégorie à partir du formulaire
        $idCategorie = $_POST['idCategorie'];
    
        // Récupérez le nouveau nom de la catégorie à partir du formulaire
        $nouveauNomCategorie = $_POST['nouveauNomCategorie'];
        updateNameCategorie($idCategorie, $nouveauNomCategorie);
    }

    if(isset($_POST['submitCategorie']) && isset($_FILES['image'])){
        $nom = $_POST['nomCategorie'];
        $types = $_POST['typesCategorie'];
        $imagePath = "";
        $imagePath = uploadImage();
        $imagePath = substr($imagePath, 1);
        insertCategorie($nom, $types, $imagePath); 
    }
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Catalogues</title>
    <link rel="stylesheet" href="../backend/styles/gestioncategorie.css">
</head>
<body>
    <div class="content">
        <h1>Gestion des Catalogues</h1>
        <div class="lien">
            <a href="index.php">Page d'Accueil</a>
            <a href="inventaire_commandes.php">Inventaire Commandes</a>
            <a href="gestion_produits.php">Gestion des produits</a>
            <form action="../logout.php" method="POST"> 
                <input type="hidden" value="logout" name="logout"></input>
                <button type="submit"><span>Se déconnecter</span></button>
            </form>
        </div>   
        <div class="container">
            <div class="menu">
                <ul>
                    <li><a href="#catalogueCategorie" class="active">Catalogue categorie</a></li>
                    <li><a href="#NewCategorie">Ajouter categorie</a></li>
                </ul>
            </div>
            <div class="test">
                <div class="content catalogue" id="catalogueCategorie">
                    <div class="modal2">
                        <section class="liste" id="categorie">
                            <h2>Catégories</h2>
                            <?php
                                $query="SELECT c.idCategorie AS idCategorie, c.nom AS category, c.photo AS imageCategorie, GROUP_CONCAT(t.nom ORDER BY t.nom ASC) AS types
                                        FROM categorie c
                                        LEFT JOIN typeproduit t ON c.idCategorie = t.idCategorie
                                        GROUP BY c.nom";
                                
                                $result = $SQLconn->conn->query($query);
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Affichez les détails du produit
                                        echo '<div class="product">';
                                        echo '<div class="product-image"><img src="../' . $row['imageCategorie'] . '" alt="Photo categorie"></div>';
                                        echo '<div class="product-info">';
                                        echo '<p>Nom : ' . $row['category'] . '</p>';
                                        echo '<p>Types : ' . $row['types'] . '</p>';
                                        /* AJAX
                                        echo '<div class="edit-container" id="editContainer' . $row['idCategorie'] . '">';
                                        echo '<input type="text" name="nouveauNomCategorie" data-id="' . $row['idCategorie'] . '" id="nouveauNomCategorie' . $row['idCategorie'] . '" placeholder="Nouveau nom" required style="display: none;">';
                                        echo '<button class="edit-button" type="button" onclick="activerModeEdition(\'' . $row['idCategorie'] . '\')">Renommer</button>';
                                        echo '<button class="edit-button" type="submit" name="edit" data-id="' . $row['idCategorie'] . '" style="display: none;">Enregistrer</button>';
                                        echo '</div>';
                                        echo '<div id="confirmationMessage' . $row['idCategorie'] . '" style="display: none;"></div>';
                                        */
                                        echo '<form method="post" action="gestion_catalogues.php">';
                                        echo '<input type="hidden" name="idCategorie" value="' . $row['idCategorie'] . '">';
                                        echo '<input type="text" name="nouveauNomCategorie" data-id="' . $row['idCategorie'] . '" id="nouveauNomCategorie" placeholder="Nouveau nom" required style="display: none;">';
                                        echo '<button class="edit-button" type="button" onclick="afficherChampModification(\'' . $row['idCategorie'] . '\')">Renommer</button>';
                                        echo '<button class="edit-button" type="submit" name="edit" data-id="' . $row['idCategorie'] . '" style="display: none;">Enregistrer</button>';
                                        echo '</form>';

                                        echo '<form method="post" action="gestion_catalogues.php">';
                                        echo '<input type="hidden" name="idCategorie" value="' . $row['idCategorie'] . '">';
                                        echo '<button class="delete-button" type="submit" name="delete" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette commande ?\');">Supprimer</button>';
                                        echo '</form>';
                                        echo '</div>';
                                        echo '</div>';
                                    }

                                    // Fermez le dernier groupe de produits
                                    echo '</div></li>';
                                } else {
                                    echo '<li>Aucune categorie trouvée.</li>';
                                }
                            ?>
                        </section>
                    </div>
                </div>
                <div class="content AjoutCategorie" id="NewCategorie">
                    <section class="Add">
                        <h2>Nouvelle categorie</h2>
                        <form action="gestion_catalogues.php" method="post" enctype="multipart/form-data">
                            <label for="nomCategorie">Nom de la catégorie:</label>
                            <input type="text" id="nomCategorie" name="nomCategorie" required>

                            <label for="typesCategorie">Types de la catégorie (séparés par des virgules):</label>
                            <input type="text" id="typesCategorie" name="typesCategorie" required>

                            <label for="imageCategorie">Image de la catégorie:</label>
                            <input type="file" id="imageCategorie" name="image" accept="image/*" required>

                            <button type="submit" name="submitCategorie">Ajouter Catégorie</button>
                        </form>
                    </section>
                </div>
                </div>
                
            
        </div> 
    </div>
    <script>
        //----------------------------------------------------------------------------
        document.addEventListener("DOMContentLoaded", function () {
            // Récupérez les liens du menu
            const menuLinks = document.querySelectorAll(".menu a");

            // Parcourez les liens pour ajouter des écouteurs d'événements de clic
            menuLinks.forEach((link) => {
                    link.addEventListener("click", (e) => {
                    // Supprimez la classe 'active' de tous les liens
                    menuLinks.forEach((l) => l.classList.remove("active"));
                    // Ajoutez la classe 'active' uniquement au lien cliqué
                    link.classList.add("active");

                    // Récupérez les sections de contenu
                    const personalInfoSection = document.getElementById("catalogueCategorie");
                    const NewCategorieSection = document.getElementById("NewCategorie");

                    // Affichez ou masquez les sections en fonction du lien cliqué
                    if (link.getAttribute("href") === "#catalogueCategorie") {
                        personalInfoSection.style.display = "block";
                        NewCategorieSection.style.display = "none";
                    } else if (link.getAttribute("href") === "#NewCategorie") {
                        personalInfoSection.style.display = "none";
                        NewCategorieSection.style.display = "block";
                    }
                });
            });
        });
        //----------------------------------------------------------------------------

        function afficherChampModification(idCategorie) {
            // Masquer tous les champs de modification existants
            var tousLesChamps = document.querySelectorAll('input[name="nouveauNomCategorie"]');
            tousLesChamps.forEach(function(champ) {
                champ.style.display = 'none';
            });

            // Afficher le champ de modification spécifique
            var champSpecifique = document.querySelector('input[name="nouveauNomCategorie"][data-id="' + idCategorie + '"]');
            champSpecifique.style.display = 'inline-block';

            // Masquer tous les boutons "Modifier" existants
            var tousLesBoutonsModifier = document.querySelectorAll('.edit-button');
            tousLesBoutonsModifier.forEach(function(bouton) {
                bouton.style.display = 'none';
            });


            // Afficher le bouton "Enregistrer" spécifique
            var boutonEnregistrer = document.querySelector('.edit-button[data-id="' + idCategorie + '"]');
            boutonEnregistrer.style.display = 'inline-block';
            var nouveauNom = document.getElementById('nouveauNomCategorie' + idCategorie).value;
            var confirmationMessage = document.getElementById('confirmationMessage' + idCategorie);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateCategorie.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Afficher le message de confirmation
                    confirmationMessage.innerHTML = xhr.responseText;
                    confirmationMessage.style.display = 'block';
                }
            };

            // Envoyer les données au script PHP pour la mise à jour
            var data = 'idCategorie=' + idCategorie + '&nouveauNomCategorie=' + encodeURIComponent(nouveauNom);
            xhr.send(data);
        }
</script>
</body>
</html>