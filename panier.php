<?php
  include("./initialize.php");
  include('navbar.php');

  if(isset($_POST['delete_cart'])) { 
    deleteCart();
  }
  if (isset($_POST['quantity'])){
    if(isset($_POST['plus'])){
      $idDeclinaison = $_POST['idDeclinaison'];
      $selectedQuantity = $_POST['quantity'];
      $selectedQuantity++;
      updateQuantiteProduct($idDeclinaison, $selectedQuantity);
    }elseif(isset($_POST['moins'])){
      $idDeclinaison = $_POST['idDeclinaison'];
      $selectedQuantity = $_POST['quantity'];
      $selectedQuantity--;
      updateQuantiteProduct($idDeclinaison, $selectedQuantity);
    }
  }
  if(isset($_POST['order'])) { 
    $total = $_POST['total'];
    insertCommande($total);
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
            $stock = $productData['stock'];
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
          <form action="panier.php" method="post">
            <input type="hidden" name="idDeclinaison" value="<?php echo $key; ?>">
            <input type="hidden" name="idProduit" value="<?php echo $idProduit; ?>">
            <input type="hidden" name="taille" value="<?php echo $produitTaille; ?>">
            <input type="hidden" name="couleur" value="<?php echo $couleurProduit; ?>">
            <label for="quantity"></label>
            <div class="quantity-input">
                <button class="quantity-btn minus" name="moins"><span>-</span></button>
                  <?php
                      if($selectedQuantity > $stock){
                        $selectedQuantity = $stock;
                        echo '<script>alert("Stock insuffisant")</script>';
                        ?>
                        <input type="number" name="quantity" id="quantity" min="0" max="<?php echo $stock; ?>" value="<?php echo $selectedQuantity; ?>" onkeyup="onlyNumber();">
                        <?php
                      }
                  ?>
                  <input type="number" name="quantity" id="quantity" min="0" max="9" value="<?php echo $selectedQuantity; ?>" onkeyup="onlyNumber();">
                <button class="quantity-btn plus" name="plus"><span>+</span></button>
            </div>
          </form>
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
  <form action="panier.php" method="post">
    <div class="container">
      <input type="hidden" name="idDeclinaison" value="<?php echo $key; ?>">
      <input type="hidden" name="stock" value="<?php echo $stock; ?>">
      <input type="hidden" name="total" value="<?php echo $total; ?>">
      <button class="order" name="order">
        <span class="default">Validé Panier</span>
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
  </form>
  <?php
  }else{
    ?>
    <tr>
      <td>
        <div class="viderpanier">
        <form method="post">
          <button name="delete_cart" type="submit"><span>Vider panier</span></button>
        </form>
        </div>
      </td>
      <td>
        <div class="paniervide">
          <p>Votre panier est vide</p>
        </div>
      </td>
      <td><p>Total du Panier : <?php echo $total; ?> €</p></td>
  </tr>
  </table>
  <!-- button disabled si le panier est vide -->
  <div class="container">
    <button class="order" disabled>
      <span class="default">Validé Panier</span>
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
  }
?>
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

    //----------------------------------------------------------------------------
  </script>
</body>
</html>
