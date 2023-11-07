<?php
    if (isset($_POST['commander_maintenant'])) {
        $redirect = "Location: panier.php";
        header($redirect);
    }
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php"); 
    include("./affichageproduit.php");
    include("./avis.php");
    include("./functionpanier.php");
    include('./navbar.php');
       
    
    // Initialise le path du produit
    $idProduit = $_GET['idProduit'];
    $categorie = getCategoryNameByProductId($idProduit);
    
    $avis = insertAvis($idProduit);
    $voirAvis = getAvisWithIdProduit($idProduit);

    if (isset($_POST['couleur'])){
        //creation de panier faite a la connexion
        $idDeclinaison = getDeclinaisonProduct($_POST['taille'], $_POST['couleur'], $idProduit);
        $idPrix = getIdprixByIdproduit($idProduit);
        $selectedQuantity = $_POST['quantity'];
        addProduct($idDeclinaison, $selectedQuantity, $idPrix);
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/produits.css">
    <title>Produits</title>
</head>
<body>
    <?php
        if($avis["success"]){
            echo '<h3 class="successMessage">Avis insérer avec succès !</h3>';
        }
        elseif ($avis["attempted"]){
            echo '<h3 class="errorMessage">'.$newAccountStatus["error"].'</h3>';
        }
    ?>
    <?php
        $product = getProductById($idProduit); 
        if ($product == 0) {
            echo '<h3 class="errorMessage">Aucun produit ne correspond à votre recherche</h3>';
            ?>
            <div class="footer">
            <?php
                include('footer.html');
            ?>
            </div>
            <?php
        } else {
            foreach ($product as $productData) {
                $productName = $productData['productName'];
                $productImage = $productData['productImage'];
                $productPrice = $productData['productPrice'];
                $productDescription = $productData['productDescription'];
                $productMaterial = $productData['productMaterial'];
                $productSizes = explode(',', $productData['sizes']);
                $productColors = explode(',', $productData['colors']);
            }?>
            <div class="product-path">
                <a href="boutique.php">Boutique</a> &gt;
                <a href="CatalogueProduit.php?categorie=<?php echo $categorie; ?>"><?php echo $categorie; ?></a> &gt;
                <?php echo $productName; ?>
            </div>

            <div class="products">
                <div class="card">
                    <div class="poster">
                        <img src="<?php echo $productImage; ?>" alt="Photo produitn">
                    </div>
                    <form action="produits.php?idProduit=<?php echo $idProduit; ?>" method="post">
                        <div class="product-info">
                        
                            <h1><?php echo $productName; ?></h1>
                            <p><?php echo $productDescription; ?></p>
                            <label for="size">Description :</label>
                            <p><?php echo $productMaterial; ?></p>
                            <h2><?php echo $productPrice; ?> € </h2>
                            <label for="size">Taille :</label>
                            <select name="taille" id="taille">
                            <?php
                                foreach ($productSizes as $sizes) {    
                                    echo '<option value="' . $sizes . '">' . $sizes . '</option>';
                                }
                            ?>
                            </select>
                            <label for="color">Couleur : </label>
                            <div class="tags">                                
                                <?php 
                                    foreach ($productColors as $color) { 
                                            if($color == $productColors[0]){?>
                                                <input type="radio" name="couleur" value="<?php echo $color; ?>" id="<?php echo $color; ?>" checked />
                                            <?php }else{?>
                                                <input type="radio" name="couleur" value="<?php echo $color; ?>" id="<?php echo $color; ?>" />
                                            <?php } ?>    
                                            <label for="<?php echo $color; ?>"><?php echo $color; ?></label>
                                <?php } ?>
                            </div>
                            <?php if($loggedIn) { ?>
                                <label for="quantity">Quantité :</label>
                                <div class="quantity-input">
                                    <div class="quantity-btn minus" id="minusBtn"><span>-</span></div>
                                    <input type="number" name="quantity" id="quantity" min="1" max="9" value="1" onkeyup="onlyNumber();">
                                    <div class="quantity-btn plus" id="plusBtn"><span>+</span></div>
                                </div>
                                <button class="buy-now" name="commander_maintenant" type="submit">Commander maintenant</button>
                                <button class="add-to-cart" name="ajouter_au_panier" type="submit">Ajouter au panier</button>
                            <?php }else{ ?>
                                <p>Vous devez être connecté pour ajouter au panier.</p>
                            <?php 
                                }                   
                            ?>                        
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <div class="left-side Avis">
                    <?php
                        if (empty($voirAvis)) {
                            echo '<div class="avis-item">';
                            echo '<div class="avis-header">';
                            echo '<ul>';
                            echo '<li>';
                            echo '<span class="user">Aucun avis pour ce produit</span>';
                            echo '</li>';
                            echo '</ul>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            foreach ($voirAvis as $avisItem){
                                $note = $avisItem['noteAvis'];
                                $commentaire = $avisItem['Avis'];
                                $nomUtilisateur = $avisItem['nomUtilisateur'];
            
                                echo '<div class="avis-item">';
                                echo '<div class="avis-header">';
                                echo '<ul>';
                                echo '<li>';
                                echo '<span class="user">' . $nomUtilisateur . '</span>';
                                echo '</li>';
                                echo '<li>';
                                echo '<span class="notes">';
                                echo '<span class="etoiles">' . generateStars($note) . '</span>';
                                echo '<span class="note">' . $note . '.0</span>';
                                echo '</span>';
                                echo '<p class="commentaire">' . $commentaire . '</p>';
                                echo '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }                
                    ?>
                </div>
                <div class="right-side avis-form">
                    <h3>Laissez un avis</h3>
                    <form action="" method="post">
                        <label for="rating">Note :</label>
                        <div class="rating star-rating" id="rating">
                            <span class="star" data-value="1">☆</span>
                            <span class="star" data-value="2">☆</span>
                            <span class="star" data-value="3">☆</span>
                            <span class="star" data-value="4">☆</span>
                            <span class="star" data-value="5">☆</span>
                        </div>
                        <input type="hidden" name="note" id="note" value="0">
                        <label for="comment">Commentaire :</label>
                        <textarea id="comment" name="comment" rows="5" required></textarea>
                        <button type="submit">Soumettre l'avis</button>
                    </form>
                </div>
            </div>    
            <?php
            include('footer.html');
        } 
    ?>
    <script>
        
        //Gestion quantite
        //----------------------------------------------------------------------------
        document.addEventListener('DOMContentLoaded', function() {
             // Sélection des éléments
            const plusBtn = document.getElementById("plusBtn");
            const minusBtn = document.getElementById("minusBtn");
            const champ = document.getElementById('quantity');

            // Gestion de l'incrémentation de la quantité
            plusBtn.addEventListener("click", () => {
                if (champ.value < 9) {
                    champ.value++;
                }
            });

            // Gestion de la décrémentation de la quantité
            minusBtn.addEventListener("click", () => {
                if (champ.value > 1) {
                    champ.value--;
                }
            });

            function onlyNumber() {
                //var champ = document.getElementById('quantity');
                while (champ.value.match(/[^0-9]/) || champ.value.length > 1) {
                    champ.value = champ.value.replace(/[^0-9]/, '').substring(0, 1);
                }
            }
        });
       
        //----------------------------------------------------------------------------
        
        
        //----------------------------------------------------------------------------
        // Sélectionnez tous les tags par leur classe
        const tags = document.querySelectorAll(".tag");

        // Élément pour stocker la couleur sélectionnée
        let selectedColor = null;

        // Écouteur d'événements pour le clic sur un tag
        tags.forEach(tag => {
            tag.addEventListener("click", (event) => {
                // Récupérez la couleur à partir de l'attribut data-color
                const clickedColor = event.currentTarget.getAttribute("data-color");

               // event.currentTarget.classList.toggle("selected");

               // Si une couleur est déjà sélectionnée, annulez la sélection en supprimant la classe "selected"
                if (selectedColor) {
                    const previouslySelectedTag = document.querySelector(`.tag[data-color="${selectedColor}"]`);
                    previouslySelectedTag.classList.remove("selected");
                }

                // Sélectionnez la nouvelle couleur en ajoutant la classe "selected"
                event.currentTarget.classList.add("selected");
                selectedColor = clickedColor;

                // Faites ce que vous voulez avec la couleur sélectionnée (par exemple, affichez-la)
                alert("Vous avez choisi la couleur : " + selectedColor);
            });
        });
        //----------------------------------------------------------------------------



        // Etoiles formulaire avis
        //----------------------------------------------------------------------------
        const stars = document.querySelectorAll('.star-rating .star');
        const noteInput = document.getElementById('note');

        stars.forEach((star) => {
            star.addEventListener('click', (event) => {
                const clickedStar = event.target;
                const value = clickedStar.getAttribute('data-value');
                noteInput.value = value;

                stars.forEach((s) => {
                    if (s.getAttribute('data-value') <= value) {
                        s.textContent = '★';
                        s.classList.add('selected');
                    } else {
                        s.textContent = '☆';
                        s.classList.remove('selected');
                    }
                });
            });
        });
        //----------------------------------------------------------------------------
    </script>
</body>
</html>