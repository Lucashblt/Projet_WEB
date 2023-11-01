<?php
  include("./initialize.php");
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
      include('navbar.php');
  ?>

<table>
  <tr>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Prix</th>
  </tr>
  <?php
      $panier = array(
          array("Nom du Produit 1", "Couleur 1", 19.99, 2),
          array("Nom du Produit 2", "Couleur 2", 29.99, 1),
          array("Nom du Produit 3", "Couleur 3", 9.99, 3)
      );

      $total = 0;

      foreach ($panier as $item) {
          $nomProduit = $item[0];
          $couleurProduit = $item[1];
          $prixUnitaire = $item[2];
          $quantite = $item[3];
          $prixTotal = $prixUnitaire * $quantite;
          $total += $prixTotal;
  ?>
  <tr>
      <td>
          <div class="product-cell">
              <img class="product-image" src="img/produit.png" alt="Image du Produit">
              <div>
                  <div class="product-name"><?php echo $nomProduit; ?></div>
                  <div class="product-color"><?php echo $couleurProduit; ?></div>
              </div>
          </div>
      </td>
      <td>
        <label for="quantity"></label>
        <div class="quantity-input">
            <button class="quantity-btn minus" id="minusBtn"><span>-</span></button>
            <input type="number" name="quantity" id="quantity" min="1" max="9" value="<?php echo $quantite; ?>" onkeyup="onlyNumber();">
            <button class="quantity-btn plus" id="plusBtn"><span>+</span></button>
        </div>
      </td>
      <td><?php echo $prixTotal; ?> €</td>
  </tr>
  <?php
      }
  ?>
</table>

<p>Total du Panier : <?php echo $total; ?> €</p>


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
