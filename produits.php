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
                    <span class="tag">White</span>
                    <span class="tag">Black</span>
                </div>
                <label for="quantity">Quantité :</label>
                <input type="number" name="quantity" id="quantity" min="1" value="1">
                <button class="add-to-cart">Ajouter au panier</button>
            </div>
        </div>
    </div>

    <?php
        include('footer.html');
    ?>
</body>
</html>