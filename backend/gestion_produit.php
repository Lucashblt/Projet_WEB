<?php
    include "../initialize.php";
    include "../backend/functionproduit.php";
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

    // Pagination
    $commandesParPage = 5;
    $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $debut = ($pageActuelle - 1) * $commandesParPage;

    //suprimer le produit
    if (isset($_POST["delete"])) {
        // Récupérez l'idProduit à partir du formulaire
        $idProduit = $_POST["idProduit"];
        deleteProduit($idProduit);
    }
    if (isset($_POST["save"]) && isset($_POST["newProductName"]) == NULL) {
        // Récupérez l'idProduit à partir du formulaire
        $idProduit = $_POST["idProduit"];
        $newProductName = $_POST["newProductName"];
        updateNameProduit($idProduit, $newProductName);
    }

    //ajouter le produit
    if (isset($_POST["addProduct"]) && isset($_FILES['image'])) {
        $imagePath = "";
        $imagePath = uploadImage();
        $imagePath = substr($imagePath, 1);
        $nom = $_POST["nomProduit"];
        $description = $_POST["description"];
        $matiere = $_POST["matiere"];
        $idtype = $_POST["typesProduit"];
        //$nomFournisseur = $_POST["fournisseur"];
        $prix = $_POST["prix"];
        $couleurs = $_POST["couleur"];
        $stock = $_POST["stock"];
        $idFournisseur = 1;
        insertProduit($nom, $description, $matiere, $idtype, $prix, $couleurs, $stock, $imagePath, $idFournisseur);
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produit</title>
    <link rel="stylesheet" href="../backend/styles/gestionproduit.css">
</head>
<body>
    <h1>Gestion des produits</h1>
    <div class="lien">
        <a href="index.php">Page d'Accueil</a>
        <a href="inventaire_commandes.php">Inventaire Commandes</a>
        <a href="gestion_catalogues.php">Gestion des catalogues</a>
        <form action="../logout.php" method="POST"> 
            <input type="hidden" value="logout" name="logout"></input>
            <button type="submit"><span>Se déconnecter</span></button>
        </form>
    </div>
    <div class="container">   
        <div class="menu">
            <ul>
                <li><a href="#listeproduits" class="active"> Liste produit</a></li>
                <li><a href="#ajoutproduit">Ajout de produit</a></li>
                <li><a href="#modifproduit">Modification produit</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="form-container" id="listeproduits">
                <div class="modal2">
                    <div class="modal-content2">
                        <h3>Liste de produits </h3>
                        <ul id="orders-list">
                            <?php
                            $query = "SELECT DISTINCT p.idProduit AS idProduit, p.nom AS productName, p.photoProduit AS productImage,
                                    c.nom AS categorieNom, pp.prixNet AS productPrice    
                                    FROM produit p
                                    LEFT JOIN typeproduit tp ON p.idType = tp.idType
                                    LEFT JOIN categorie c ON tp.idCategorie = c.idCategorie
                                    LEFT JOIN prixproduit pp ON p.idProduit = pp.idProduit
                                    LEFT JOIN 
                                    (SELECT idproduit , cp.nom from declinaisonproduit dp 
                                    INNER JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur 
                                    group by idproduit , cp.nom) as td_couleur on td_couleur.idproduit = p.idproduit
                                    WHERE CURRENT_DATE BETWEEN pp.dateDebut and pp.dateFin
                                    ORDER BY p.nom ASC";
                            $query .= " LIMIT $debut, $commandesParPage";

                            $result = $SQLconn->conn->query($query);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $productID = $row["idProduit"];
                                    $productName = $row["productName"];
                                    $productPrice = $row["productPrice"];
                                    $productCategory = $row["categorieNom"];
                                    $productImage = "../" . $row["productImage"];

                                    echo "<li class='product'>
                                                <div class='product-image'><img src='$productImage' alt='$productName'></div>
                                                <div class='product-info'>
                                                    <h4>$productName</h4>
                                                    <p>Prix : $productPrice €</p>
                                                    <p>Catégorie : $productCategory</p>
                                                </div>
                                                <div>
                                                    <form method='post' action='gestion_produit.php'>
                                                        <input type='hidden' name='idProduit' value='$productID'>
                                                        <input type='text' id='renameInput-$productID' name='newProductName' placeholder='$productName' style='display:none;'>
                                                        <button class='rename-button' type='button' onclick='showRenameInput($productID)' name='rename' >Renommer</button>
                                                        <button class='rename-button' type='submit' name='save'  style='display: none;'>Enregistrer</button>
                                                    </form>
                                                    <form method='post' action='gestion_produit.php'>
                                                        <input type='hidden' name='idProduit' value='$productID'>
                                                        <button class='delete-button' type='submit' name='delete' onclick='return confirm(\'Êtes-vous sûr de vouloir supprimer ce produit ?\');'>Supprimer</button>
                                                    </form>
                                                </div>
                                            </li>";                                   
                                    
                                }
                            }   ?>                     
                        </ul>
                        <div class="pagination">
                            <?php
                            $sql = "SELECT COUNT(*) FROM commandes";
                            $result = $SQLconn->conn->query($sql);
                            $totalCommandes = $result->fetch_row()[0];
                            $pagesTotales = ceil($totalCommandes / $commandesParPage);

                            for ($i = 1; $i <= $pagesTotales; $i++) {
                                echo '<a href="?page=' . $i . '">' . $i . '</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="previous-orders" id="ajoutproduit">
                <div class="modal2">
                    <div class="modal-content2">
                        <h3>Ajout de produit </h3>
                        <ul class="ajouter">
                            <form action="gestion_produit.php" method="post" enctype="multipart/form-data">
                                <label for="nomProduit">Nom produit :</label>
                                <input type="text" id="nomProduit" name="nomProduit" required>

                                <label for="description">Description :</label>
                                <input type="text" id="description" name="description" required>

                                <label for="matiere">Matière (exemple : coton 50% laine 50%) :</label>
                                <input type="text" id="matiere" name="matiere" required>

                                <label for="fournisseur">Fournisseur :</label>
                                <?php
                                    $query = "SELECT nom FROM fournisseur";
                                    $result = $SQLconn->conn->query($query);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $fournisseurName = $row["nom"];

                                            echo "<label>
                                                    $fournisseurName
                                                    <input type='radio' name='fournisseur' value='$fournisseurName' required>
                                                    
                                                </label>";
                                        }
                                    }
                                ?>

                                <label for="typesProduit">Type de produit:</label>
                                <?php
                                    $query = "SELECT idType, nom FROM typeproduit";
                                    $result = $SQLconn->conn->query($query);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $typeID = $row["idType"];
                                            $typeName = $row["nom"];

                                            echo "<label>
                                                    $typeName
                                                    <input type='radio' name='typesProduit' value='$typeID' required>
                                                    
                                                </label>";
                                        }
                                    }
                                ?>

                                <label for="prix">Prix :</label>
                                <input type="number" id="prix" name="prix" required>
                                
                                <label for="couleurProduit">Couleur de produit :</label>
                                <?php
                                    $query = "SELECT nom FROM couleurproduit";
                                    $result = $SQLconn->conn->query($query);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $typeName = $row["nom"];
                                            echo "$typeName <input type='checkbox' name='couleur[]' value='$typeName'>";
                                        }
                                    }
                                ?>                                    
                                <label for="stock">Stock :</label>
                                <input type="number" min="1" value="1000" id="stock" name="stock" required>

                                <label for="imageCategorie">Image de la catégorie:</label>
                                <input type="file" id="imageCategorie" name="image" accept="image/*" required>

                                <input type="submit" name="addProduct" value="Ajouter">
                            </form>                       
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modifproduit" id="modifproduit">
                <div class="modal2">
                    <div class="modal-content2">
                        <h3>Modification de produit</h3>
                        <ul id="orders-list">             
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script>
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
                    const listeproduitsSection = document.getElementById("listeproduits");
                    const ajoutproduitSection = document.getElementById("ajoutproduit");
                    const modifproduitSection = document.getElementById("modifproduit");

                    // Affichez ou masquez les sections en fonction du lien cliqué
                    if (link.getAttribute("href") === "#listeproduits") {
                        listeproduitsSection.style.display = "block";
                        ajoutproduitSection.style.display = "none";
                        modifproduitSection.style.display = "none";
                    } else if (link.getAttribute("href") === "#ajoutproduit") {
                        listeproduitsSection.style.display = "none";
                        ajoutproduitSection.style.display = "block";
                        modifproduitSection.style.display = "none";
                    } else if (link.getAttribute("href") === "#modifproduit") {
                        listeproduitsSection.style.display = "none";
                        ajoutproduitSection.style.display = "none";
                        modifproduitSection.style.display = "block";
                    }
                });
            });
        });

        //----------------------------------------------------------------------------------------
        function showRenameInput(productID) {
            // Cacher tous les champs de texte de renommage
            const renameInputs = document.querySelectorAll('[id^="renameInput-"]');
            renameInputs.forEach((input) => {
                input.style.display = 'none';
            });

            // Afficher le champ de texte de renommage correspondant au produit cliqué
            const renameInput = document.getElementById(`renameInput-${productID}`);
            renameInput.style.display = 'block';

            const renameButton = document.querySelector(`[onclick="showRenameInput(${productID})"]`);
            const saveButton = renameButton.nextElementSibling; 
            renameButton.style.display = 'none';
            saveButton.style.display = 'block';
            // Mettre le focus sur le champ de texte
            renameInput.focus();
        }
        //----------------------------------------------------------------------------------------
    </script>
    
</body>
</html>
