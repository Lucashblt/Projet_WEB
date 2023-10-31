<?php
    include("./initialize.php");
    
    // Vérifier si l'utilisateur est connecté
    if (!$SQLconn->loginStatus->loginSuccessful) {
        // Rediriger vers la page d'acceuil s'il n'est pas connecté
        header("Location: home.php");
        exit;
    }

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
                        <form action="" onsubmit="return false;" method="post">
                            <h3>Information Personnelle</h3>
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
                            <label for="mdp">Mot de passe :</label>
                            <input type="password" id="mdp" name="mdp" value="<?php echo $user['password']; ?>" disabled>
                            <h3>Adresse de livraison</h3>
                            <label for="adresse">Adresse :</label>
                            <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>" disabled>
                            <label for="cp">Code Postale :</label>
                            <input type="text" id="cp" name="cp" value="<?php echo $user['codePostal']; ?>" disabled>
                            <label for="ville">Ville :</label>
                            <input type="text" id="ville" name="ville" value="<?php echo $user['ville']; ?>" disabled>
                            <label for="pays">Pays :</label>
                            <input type="text" id="pays" name="pays" value="<?php echo $user['pays']; ?>" disabled>
                            <button id="edit-info-btn">Modifier</button>
                            <button id="save-info-btn" style="display: none;" onclick="return CheckLoginForm();">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="previous-orders" id="orders">
                <h2>Commandes Précédentes</h2>
                <button id="show-orders-btn">Afficher les commandes</button>
                <ul id="orders-list" style="display: none;">
                    <!-- Les commandes précédentes de l'utilisateur seront affichées ici -->
                </ul>
            </div>
        </div>
    </div>

    <?php
        include('footer.html');
        if (isset($_POST['save-info-btn'])) {
            $nom = $SQLconn->SecurizeString_ForSQL($updatedInfo['nom']);
            $prenom = $SQLconn->SecurizeString_ForSQL($updatedInfo['prenom']);
            $pseudo = $SQLconn->SecurizeString_ForSQL($updatedInfo['pseudo']);
            $email = $SQLconn->SecurizeString_ForSQL($updatedInfo['mel']);
            $dateNaissance = $SQLconn->SecurizeString_ForSQL($updatedInfo['date_naissance']);
            $mdp = $SQLconn->SecurizeString_ForSQL($updatedInfo['mdp']);
            $adresse = $SQLconn->SecurizeString_ForSQL($updatedInfo['adresse']);
            $codePostal = $SQLconn->SecurizeString_ForSQL($updatedInfo['cp']);
            $ville = $SQLconn->SecurizeString_ForSQL($updatedInfo['ville']);
            $pays = $SQLconn->SecurizeString_ForSQL($updatedInfo['pays']);

            //Verifier s l'email n'est pas deja utilise si oui afficher un message d'erreur sinon insert le nouvel utilisateur 
            $chekEmailQuery = "SELECT * FROM utilisateur WHERE email = '".$userEmail."'";
            $emailCheckResult  = $this->conn->query($chekEmailQuery);

            if ( $emailCheckResult->num_rows != 0 ){
                $error = "Cette adresse email est déjà utilisée.";
            }else{
                $updateQuery = "UPDATE utilisateur SET nom=?, prenom=?, pseudo=?, email=?, dateNaissance=?, mdp=?, adresse=?, codePostal=?, ville=?, pays=? WHERE idUtilisateur= ?";

                // Prepare statement
                $stmt = $SQLconn->conn->prepare($updateQuery);
                
                
                // Liez les valeurs aux paramètres de la requête
                $stmt->bind_param("sssssssssi", $nom, $prenom, $pseudo, $email, $dateNaissance, $mdp, $adresse, $codePostal, $ville, $pays, $user['idUtilisateur']);
                
                if ($stmt->execute()) {
                    echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour des informations de l'utilisateur : " . $stmt->error;
                }
                // Fermez la déclaration préparée
                $stmt->close();
                
            }
        }
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
                // update dans la bdd
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
