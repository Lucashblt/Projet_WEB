<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php"); 
    // Initialise le path du produit
    $category = "boutique"; // You should set this dynamically
    $productType = "typeproduit"; // You should set this dynamically
    $productName = "pageactuel"; // You should set this dynamically
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
    ?>
    <div class="product-path">
        <a href="boutique.php">Boutique</a> &gt;
        <a href="CatalogueProduit.php?type=<?php echo $productType; ?>"><?php echo $productType; ?></a> &gt;
        <?php echo $productName; ?>
    </div>

    <div class="products">
        <div class="card">
            <div class="poster">
                <img src="https://img.freepik.com/free-photo/men-s-apparel-hoodie-rear-view_53876-97228.jpg?w=360&t=st=1697035828~exp=1697036428~hmac=83f3871a04b294558c4708ee01250a26909b335f768df5b39d68850672781629" alt="Location Unknown">
            </div>
            <div class="product-info">
                <h1>Dream And Reality</h1>
                <p>A stylish and comfortable hoodie for any occasion. Available in multiple colors.</p>
                <h2>50€</h2>
                <label for="size">Taille :</label>
                <select name="size" id="size">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
                <label for="color">Couleur : </label>
                <div class="tags">
                    <span class="tag" id="white">White</span>
                    <span class="tag" id="black">Black</span>
                </div>
                <?php if($loggedIn) { ?>
                    <label for="quantity">Quantité :</label>
                    <div class="quantity-input">
                        <button class="quantity-btn minus"><span>-</span></button>
                        <input type="number" name="quantity" id="quantity" min="1" max="9" value="1">
                        <button class="quantity-btn plus"><span>+</span></button>
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
            <div class="avis-item">
                <div class="avis-header">
                    <ul>
                        <li>
                            <span class="user">Utilisateur 1</span>
                        </li>
                        <li>
                            <span class="notes">
                                <span class="etoiles">★★★★☆</span>
                                <span class="note">4.0</span>
                            </span>
                            <p class="commentaire">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam sapien nec nisi vestibulum, etiam cursus nulla eu sapien volutpat. Nulla dapibus felis eu orci blandit.Nulla dapibus felis eu orci blandit.</p>
                        </li>
                        <li>
                            <span class="user">Utilisateur 2</span>
                        </li>
                        <li>
                            <span class="notes">
                                <span class="etoiles">★★★★☆</span>
                                <span class="note">4.0</span>
                            </span>
                            <p class="commentaire">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam sapien nec nisi vestibulum, etiam cursus nulla eu sapien volutpat. Nulla dapibus felis eu orcNulla dapibus felis eu orci blandit.i blandit.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right-side avis-form">
            <h3>Laissez un avis</h3>
            <form>
                <label for="rating">Note :</label>
                <div class="rating star-rating" id="rating">
                    <span class="star" data-value="1">☆</span>
                    <span class="star" data-value="2">☆</span>
                    <span class="star" data-value="3">☆</span>
                    <span class="star" data-value="4">☆</span>
                    <span class="star" data-value="5">☆</span>
                </div>
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
        // Sélectionnez les balises span pour les couleurs
        //----------------------------------------------------------------------------
        const whiteTag = document.getElementById("white");
        const blackTag = document.getElementById("black");

        // Écouteur d'événement pour les balises span
        whiteTag.addEventListener("click", () => {
            // Désélectionnez toutes les balises
            whiteTag.classList.add("selected");
            blackTag.classList.remove("selected");

            // Mettez à jour la sélection de couleur ici (par exemple, affectez la valeur "White" à une variable)
        });

        blackTag.addEventListener("click", () => {
            // Désélectionnez toutes les balises
            whiteTag.classList.remove("selected");
            blackTag.classList.add("selected");

            // Mettez à jour la sélection de couleur ici (par exemple, affectez la valeur "Black" à une variable)
        });
        //----------------------------------------------------------------------------

        //Gestion quantite
        //----------------------------------------------------------------------------
        // Sélection des éléments
        const quantityInput = document.getElementById("quantity");
        const plusBtn = document.querySelector(".plus");
        const minusBtn = document.querySelector(".minus");

        // Gestion de l'incrémentation de la quantité
        plusBtn.addEventListener("click", () => {
            if (quantityInput.value < 9) {
                quantityInput.value++;
            }
        });

        // Gestion de la décrémentation de la quantité
        minusBtn.addEventListener("click", () => {
            if (quantityInput.value > 1) {
                quantityInput.value--;
            }
        });

        // Empêcher la saisie de caractères non numériques
        quantityInput.addEventListener("input", () => {
            if (!/^\d*$/.test(quantityInput.value)) {
                quantityInput.value = quantityInput.value.replace(/[^\d]/g, "");
            }
        });

        //----------------------------------------------------------------------------

        // Etoiles formulaire avis
        //----------------------------------------------------------------------------
        const stars = document.querySelectorAll('.star-rating .star');
        const rating = document.querySelector('#rating');

        stars.forEach((star) => {
            star.addEventListener('click', (event) => {
                const clickedStar = event.target;
                const value = clickedStar.getAttribute('data-value');
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