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
          <th>Prix unitaire</th>
          <th>Quantité</th>
          <th>Prix total</th>
      </tr>
      <?php
          // Supposons que vous ayez un tableau de produits dans le panier
          $panier = array(
              array("Nom du Produit 1", 19.99, 2),
              array("Nom du Produit 2", 29.99, 1),
              array("Nom du Produit 3", 9.99, 3)
          );

          $total = 0;

          foreach ($panier as $item) {
              $nomProduit = $item[0];
              $prixUnitaire = $item[1];
              $quantite = $item[2];
              $prixTotal = $prixUnitaire * $quantite;
              $total += $prixTotal;
      ?>
      <tr>
          <td><?php echo $nomProduit; ?></td>
          <td><?php echo $prixUnitaire; ?> €</td>
          <td><?php echo $quantite; ?></td>
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
  </script>
</body>
</html>
