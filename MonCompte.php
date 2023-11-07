<?php
    include("./initialize.php");
    
    ini_set('display_errors', 1); 
    error_reporting(E_ALL); 

    // Vérifier si l'utilisateur est connecté
    if (!$SQLconn->loginStatus->loginSuccessful) {
        // Rediriger vers la page d'acceuil s'il n'est pas connecté
        header("Location: home.php");
        exit;
    }

    //update le compte de l'utilisateur
    $update = $SQLconn->updateAccount();
    
    $query = "SELECT * FROM utilisateur WHERE email = '" . $SQLconn->loginStatus->userEmail . "'";
    $result = $SQLconn->conn->query($query);
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // Gérer le cas où aucune information d'utilisateur n'est trouvée
        echo "Aucune information d'utilisateur trouvée.";
    }
    
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
        if($update["success"]){
            echo '<h3 class="successMessage">Mise à jour avec succès</h3>';
        }
        elseif ($update["attempted"]){
            echo '<h3 class="errorMessage">'.$newAccountStatus["error"].'</h3>';
        }
    ?>
    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="#personal-info" class="active">Information Personnelle</a></li>
                <li><a href="#orders">Commandes Précédentes</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="form-container" id="personal-info">
                <div class="modal2">
                    <div class="modal-content2">
                    <p>
                        <form action="MonCompte.php" method="post">
                            <h3>Information Personnelle</h3>
                            <input type="hidden" name="idUtilisateur" value="<?php echo $user['idUtilisateur']; ?>">
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>" disabled>
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>" disabled>
                            <label for="pseudo">Pseudo :</label>
                            <input type="text" id="pseudo" name="pseudo" value="<?php echo $user['pseudo']; ?>" disabled>
                            <label for="mel">E-Mail :</label>
                            <input type="text" id="mel" name="mel" value="<?php echo $user['email']; ?>" disabled>
                            <label for="date_naissance">Date de naissance :</label>
                            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $user['dateNaissance']; ?>" disabled>
                            <h3>Adresse de livraison</h3>
                            <label for="adresse">Adresse :</label>
                            <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>" disabled>
                            <label for="cp">Code Postale :</label>
                            <input type="text" id="cp" name="cp" value="<?php echo $user['codePostal']; ?>" disabled>
                            <label for="ville">Ville :</label>
                            <input type="text" id="ville" name="ville" value="<?php echo $user['ville']; ?>" disabled>
                            <label for="pays">Pays :</label>
                            <input type="text" id="pays" name="pays" value="<?php echo $user['pays']; ?>" disabled>
                            <button id="save-info-btn" style="display: none;" type="submit" >Enregistrer</button>
                        </form>
                        <button id="edit-info-btn">Modifier</button>
                    </div>
                </div>
            </div>
            <div class="previous-orders" id="orders">
                <h3>Commandes Précédentes</h3>
                <ul id="orders-list">
                    <?php
                        $idUtilisateur = $user['idUtilisateur'];
                        $query="SELECT c.*, cl.* , p.nom AS nomProduit, p.photoProduit AS photoProduit, 
                            tap.taille AS nomTaille, cp.nom AS nomCouleur, pp.prixNet AS prixNet,
                            c.status AS statusCommande, c.total AS totalCommande
                            FROM commandes c
                            INNER JOIN commandeslignes cl ON c.idCommande = cl.idCommande
                            INNER JOIN prixproduit pp ON cl.idPrix = pp.idPrix
                            INNER JOIN declinaisonproduit dp ON cl.idDeclinaison = dp.idDeclinaison
                            INNER JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                            INNER JOIN tailleproduit tap ON dp.idTaille = tap.idTaille
                            INNER JOIN produit p ON dp.idProduit = p.idProduit
                            WHERE c.idUtilisateur = $idUtilisateur
                            ORDER BY c.dateCommande DESC";
                        
                        $result = $SQLconn->conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            $currentCommandeId = null; // Initialisez une variable pour suivre la commande en cours
                            while ($row = $result->fetch_assoc()) {
                                if ($currentCommandeId !== $row['idCommande']) {
                                    // Nouvelle commande, affichez les détails de la commande
                                    if ($currentCommandeId !== null) {
                                        echo '</div></li>';
                                    }

                                    echo '<li class="order-item">';
                                    echo '<div class="order-details">';
                                    echo '<p>Date de commande: ' . $row['dateCommande'] . '</p>';
                                    echo '<p>Status: ' . $row['statusCommande'] . '</p>';
                                    echo '<p>Total: ' . $row['totalCommande'] . ' €</p>';
                                    echo '</div>';
                                    echo '<div class="products">';
                                    $currentCommandeId = $row['idCommande'];
                                }

                                // Affichez les détails du produit
                                echo '<div class="product">';
                                echo '<div class="product-image"><img src="' . $row['photoProduit'] . '" alt="Photo du produit"></div>';
                                echo '<div class="product-info">';
                                echo '<p>Nom du Produit: ' . $row['nomProduit'] . '</p>';
                                echo '<p>Couleur: ' . $row['nomCouleur'] . '</p>';
                                echo '<p>Taille: ' . $row['nomTaille'] . '</p>';
                                echo '<p>Prix Unitaire : ' . $row['prixNet']. ' €</p>';
                                echo '<p>Quantité: ' . $row['quantite'] . '</p>';
                                echo '<p>Prix Total: ' . $row['prixNet'] * $row['quantite'] . ' €</p>';
                                echo '</div>';
                                echo '</div>';
                            }

                            // Fermez le dernier groupe de produits
                            echo '</div></li>';
                        } else {
                            echo '<li>Aucune commande précédente trouvée.</li>';
                        }
                    ?>
                        
                </ul>
            </div>
        </div>
    </div>

    <?php
        include('footer.html');
    ?>
    <script>
        //----------------------------------------------------------------------------
        
        // Récupérez tous les liens du menu
        const menuLinks = document.querySelectorAll(".menu a");

        // Parcourez les liens pour ajouter des écouteurs d'événements de clic
        menuLinks.forEach((link) => {
            link.addEventListener("click", (e) => {
                // Supprimez la classe 'active' de tous les liens
                menuLinks.forEach((l) => l.classList.remove("active"));
                // Ajoutez la classe 'active' uniquement au lien cliqué
                link.classList.add("active");
            });
        });

        //----------------------------------------------------------------------------
        // bouton modifier/enregistrer
        //----------------------------------------------------------------------------
        // Déplacez ces déclarations en dehors de showContent pour qu'elles soient accessibles globalement
        const editInfoButton = document.getElementById('edit-info-btn');
        const saveInfoButton = document.getElementById('save-info-btn');
        const inputs = document.querySelectorAll('.modal-content2 input');
        const showOrdersButton = document.getElementById('show-orders-btn');
        const ordersList = document.getElementById('orders-list');

        // Fonction pour afficher le contenu sélectionné
        function showContent(contentId) {
            const contentSections = document.querySelectorAll('.content > div');
            contentSections.forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(contentId).style.display = 'block';
        }

        // Écouteurs d'événements pour les liens du menu
        document.querySelectorAll('.menu a').forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const contentId = link.getAttribute('href').substring(1);
                showContent(contentId);
            });
        });

        // Affiche les informations personnelles par défaut
        showContent('personal-info');

        // Écouteur d'événement pour activer l'édition des informations
        editInfoButton.addEventListener('click', () => {
            inputs.forEach(input => {
                input.removeAttribute('disabled');
            });
            editInfoButton.style.display = 'none';
            saveInfoButton.style.display = 'block';
        });

        // Écouteur d'événement pour afficher les commandes précédentes
        showOrdersButton.addEventListener('click', () => {
            // Récupérer les commandes précédentes de l'utilisateur depuis le backend et afficher la liste
            ordersList.style.display = 'block';
            showOrdersButton.style.display = 'none';
        });
        //----------------------------------------------------------------------------
        
        //----------------------------------------------------------------------------
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
                //retour a l'etat initiale du form
                inputs.forEach(input => {
                    input.setAttribute('disabled', true);
                });
                editInfoButton.style.display = 'block';
                saveInfoButton.style.display = 'none';
                return true;
            }
        }
        //----------------------------------------------------------------------------
    </script>
</body>
</html>
