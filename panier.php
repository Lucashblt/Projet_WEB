<?php
  include("./initialize.php");
  include('navbar.php');

  if(isset($_POST['delete_cart'])) { 
    deleteCart();
  }
    
  
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./styles/panier.css">
  <title>Panier</title>
</head>
<body>
  <?php
      
      //var_dump($_SESSION['panier']);
  ?>
<table>
  <tr>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Prix</th>
  </tr>

  <?php
    $total = 0;
    if (isset($_SESSION['panier'])) {
      $panier = $_SESSION['panier'];
      echo $panier['selectedQuantity'][0];

      foreach ($panier['idDeclinaison'] as $key => $idDeclinaison) {
        $selectedQuantity = $panier['selectedQuantity'][$key];
        $idPrix = $panier['idPrix'][$key];
        $product = getInfoProductByIdeclinaison($idDeclinaison);
        if ($product == 0){
          echo "Erreur";
        }else{
          foreach ($product as $productData) {
            $idProduit = $productData['idProduit'];
            $produitTaille = $productData['nomTaille'];
            $couleurProduit = $productData['nomCouleur'];
            $nomProduit = $productData['nomProduit'];
            $photoProduit = $productData['photoProduit'];
            $prixNet = getPriceById($idPrix);
            $prixTotal = $prixNet * $selectedQuantity;
            ?>
    <tr>
        <td>
            <div class="product-cell">
                <img class="product-image" src="<?php echo $photoProduit ?>" alt="Image du Produit">
                <div>
                    <div class="product-name"><a href="produits.php?idProduit=<?php echo $idProduit; ?>"><?php echo $nomProduit; ?></a></div>
                    <div class="product-color"><?php echo $couleurProduit; ?></div>
                    <div class="product-taille"><?php echo $produitTaille; ?></div>
                </div>
            </div>
        </td>
        <td>
          <label for="quantity"></label>
          <div class="quantity-input">
              <div class="quantity-btn minus" id="minusBtn"><span>-</span></div>
                <input type="number" name="quantity" id="quantity" min="1" max="9" value="<?php echo $selectedQuantity; ?>" onkeyup="onlyNumber();">
              <div class="quantity-btn plus" id="plusBtn"><span>+</span></div>
          </div>
        </td>
        <td><?php echo $prixTotal; ?> €</td>
    </tr>
            <?php
          }
          
          $total += $prixTotal;
        }
      }
  ?>

  <tr>
      <td>
        <div class="viderpanier">
        <form method="post">
          <button name="delete_cart" type="submit"><span>Vider panier</span></button>
        </form>
        </div>
      </td>
      <td></td>
      <td><p>Total du Panier : <?php echo $total; ?> €</p></td>
  </tr>
</table>

  
<div class="container">
  <button class="order">
    <span class="default">Complete Order</span>
    <span class="success">Order Placed
      <svg viewbox="0 0 12 10">
        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
      </svg>
    </span>
    <div class="box"></div>
    <div class="truck">
      <div class="back"></div>
      <div class="front">
        <div class="window"></div>
      </div>
      <div class="light top"></div>
      <div class="light bottom"></div>
    </div>
      <div class="lines"></div>
  </button>
</div>
  
  <?php

      }else{
        echo '<h3 class="errorMessage">Votre panier est vide</h3>';
      }
  ?>
</table>
  


  <div class="footer">
    <?php
        include('footer.html');
    ?>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script>
    //----------------------------------------------------------------------------
    $('.order').click(function(e) {
    let button = $(this);

    if(!button.hasClass('animate')) {
        button.addClass('animate');
        setTimeout(() => {
            button.removeClass('animate');
        }, 10000);
    }
    });
    //----------------------------------------------------------------------------


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
  </script>
</body>
</html>
