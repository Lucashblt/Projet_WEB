<style>
    

    p {
    font-family: Georgia, serif;
    font-size: 0.9em;
    margin: 1em 0;
}

label {
    font-weight: bold;
    margin-top: 10px;
}

select, input {
    padding: 5px;
    margin: 5px 0;
}

.quantity-btn {
    background-color: #fff;
    color: #000;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s ease-out;
}

.quantity-btn:hover {
    background-color: #000;
    color: #fff;
}

.quantity-input {
    display: flex;
    align-items: center;
}

.plus {
    margin-left: 10px;
}

.minus {
    margin-right: 10px;
}
/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
 
/* Chrome */
input::-webkit-inner-spin-button,
input::-webkit-outer-spin-button { 
	-webkit-appearance: none;
	margin:0;
}
 
/* Opéra*/
input::-o-inner-spin-button,
input::-o-outer-spin-button { 
	-o-appearance: none;
	margin:0
}



</style>
<form action="test.php" method="post">
<label for="quantity">Quantité :</label>
                                <div class="quantity-input">
                                    <div class="quantity-btn minus" id="minusBtn"><span>-</span></div>
                                    <input type="number" name="quantity" id="quantity" min="1" max="9" value="1" onkeyup="onlyNumber();">
                                    <div class="quantity-btn plus" id="plusBtn"><span>+</span></div>
                                </div>
                                <button type="submit" name="submit"><span>Ajouter au panier</span></button>
</form>

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
</script>