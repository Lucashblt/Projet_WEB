<!DOCTYPE html>
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Panier</title> 
        <style> 
         body { font-family: Arial, sans-serif; } 
         .cart-table { width: 100%; border-collapse: collapse; } 
         .cart-table th, 
         .cart-table td { border: 1px solid #ccc; padding: 10px; text-align: center; } 
         .total-row { font-weight: bold; } 
         .checkout-btn { background-color: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; } 
         </style>
    </head> 
    <body> 
        <h1>Mon Panier</h1> 
        <table class="cart-table"> 
            <thead> 
                <tr> 
                    <th>Quantité</th> 
                    <th>Produit</th> 
                    <th>Prix Unitaire</th> 
                    <th>Prix Total</th> 
                </tr> 
            </thead> 
            <tbody> 
                <tr>
                    <td>1</td> 
                    <td>Technical Pack</td> 
                    <td>$130.00</td> 
                    <td>$104.00</td> 
                </tr> 
                <tr class="total-row"> 
                    <td colspan="3">Sous-total</td> 
                    <td>$104.00</td> 
                </tr> 
                <tr class="total-row"> 
                    <td colspan="3">Livraison</td> 
                    <td>$0.00</td> 
                </tr> 
                <tr class="total-row"> 
                    <td colspan="3">Total</td>
                    <td>$104.00</td> 
                </tr> 
            </tbody> 
        </table> 
        <button class="checkout-btn">Passez à la caisse</button> 
    </body> 
</html>