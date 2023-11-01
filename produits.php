<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php"); 
    include("./affichageproduit.php");
    include("./avis.php");
    
    // Initialise le path du produit
    $idProduit = $_GET['idProduit'];
    $categorie = getCategoryNameByProductId($idProduit);
    
    $product = getProductById($idProduit); 
    if (empty($product)) {
        echo '<h3 class="errorMessage">Aucun produit ne correspond à votre recherche</h3>';
    } else {
        foreach ($product as $productData) {
            $productName = $productData['productName'];
            $productImage = $productData['productImage'];
            $color = explode(',', $productData['colors']);
            $productPrice = $productData['productPrice'];
            $productDescription = $productData['productDescription'];
            $productSizes = explode(',', $productData['sizes']);
        }
    } 
    
    $avis = insertAvis($idProduit);
    $voirAvis = getAvisWithIdProduit($idProduit);
    
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
        include('navbar.php');
        if($avis["success"]){
            echo '<h3 class="successMessage">Avis insérer avec succès !</h3>';
        }
        elseif ($avis["attempted"]){
            echo '<h3 class="errorMessage">'.$newAccountStatus["error"].'</h3>';
        }
    ?>
    <div class="product-path">
        <a href="boutique.php">Boutique</a> &gt;
        <a href="CatalogueProduit.php?categorie=<?php echo $categorie; ?>"><?php echo $categorie; ?></a> &gt;
        <?php echo $productName; ?>
    </div>

    <div class="products">
        <div class="card">
            <div class="poster">
                <img src="<?php echo $productImage; ?>" alt="Location Unknown">
            </div>
            <div class="product-info">
                <h1><?php echo $productName; ?></h1>
                <p><?php echo $productDescription; ?></p>
                <h2><?php echo $productPrice; ?> € </h2>
                <label for="size">Taille :</label>
                <select name="size" id="size">
                <?php
                    foreach ($productSizes as $sizes) {
                        echo '<option value="' . $sizes . '">' . $sizes . '</option>';
                    }
                ?>
                </select>
                <label for="color">Couleur : </label>
                <div class="tags">
                    <?php foreach ($color as $c) { ?>
                        <span class="tag" data-color="<?php echo $c; ?>"><?php echo $c; ?></span>
                    <?php } ?>
                </div>
                <?php if($loggedIn) { ?>
                    <label for="quantity">Quantité :</label>
                    <div class="quantity-input">
                        <button class="quantity-btn minus" id="minusBtn"><span>-</span></button>
                        <input type="number" name="quantity" id="quantity" min="1" max="9" value="1" onkeyup="onlyNumber();">
                        <button class="quantity-btn plus" id="plusBtn"><span>+</span></button>
                    </div>
                    <button class="buy-now">Commender maintenant</button>
                    <button class="add-to-cart">Ajouter au panier</button>
                <?php }else{ ?>
                    <p>Vous devez être connecté pour ajouter au panier.</p>
                <?php 
                     }                   
                ?>
            </div>
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

        // Écouteur d'événements pour le clic sur un tag
        tags.forEach(tag => {
            tag.addEventListener("click", (event) => {
                // Récupérez la couleur à partir de l'attribut data-color
                const selectedColor = event.currentTarget.getAttribute("data-color");

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