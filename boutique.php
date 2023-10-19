<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/boutique.css">
    <title>Boutique</title>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <div class="filtres">
        <form action="boutique.php" method="post">
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie">
                <option value="toutes">Toutes les catégories</option>
                <option value="vetements">Vêtements</option>
                <option value="chaussures">Chaussures</option>
                <option value="accessoires">Accessoires</option>
            </select>
            <label for="typeProduits">Type de produtits</label>
            <select name="typeProduits" id="typeProduits">
                <option value="tous">Toutes les produits</option>
            </select>
            <label for="taille">Taille</label>
            <select name="taille" id="taille">
                <option value="aucune">Aucune Taille</option>
            </select>
            <label for="prix">Prix</label>
            <select name="prix" id="prix">
                <option value="tous">Tous les prix</option>
                <option value="moins20">Moins de 20 €</option>
                <option value="20-50">20 € - 50 €</option>
                <option value="50-100">50 € - 100€</option> 
                <option value="plus100">100+ €</option>
            </select>
            <button type="submit" name="submit"><span>Filtrer & Trier</span></button>
        </form>
    </div>
    <!-- trier par ...... -->
    <div class="products">
        <a href="produits.php" >
            <div class="card">
                <div class="poster"><img src="https://img.freepik.com/free-photo/men-s-apparel-hoodie-rear-view_53876-97228.jpg?w=360&t=st=1697035828~exp=1697036428~hmac=83f3871a04b294558c4708ee01250a26909b335f768df5b39d68850672781629" alt="Location Unknown"></div>
                <div class="details">
                    <h1>Dream And Reality</h1>
                    <div class="tags">
                        <span class="tag">White</span>
                        <span class="tag">Black</span>
                    </div>
                    <h2>50€</h2>
                </div>
            </div>
        </a>
        <div class="card">
            <div class="poster"><img src="https://images.unsplash.com/photo-1560547126-ccd9d56db8af?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1936&q=80" alt="Location Unknown"></div>
            <div class="details">
                <h1>#Wolf</h1>
                <div class="tags">
                    <span class="tag">Blue</span>
                    <span class="tag">White</span>
                    <span class="tag">Green</span>
                </div>
                <h2>60€</h2>
            </div>
        </div>
        <div class="card">
            <div class="poster"><img src="https://img.freepik.com/free-photo/close-up-portrait-man-shirt-mockup_23-2149260967.jpg?w=360&t=st=1697036188~exp=1697036788~hmac=527d0d3eb9219978178f8820f6da2c869d4d54ad52ccc9496d05b6ca545744b5" alt="Location Unknown"></div>
            <div class="details">
                <h1>Sweatshirt en lain</h1>
                <div class="tags">
                    <span class="tag yellow">Grey</span>
                    <span class="tag">Red</span>
                    <span class="tag blue">Black</span>
                </div>
                <h2>70€</h2>
            </div>
        </div>
        
    </div>

    <div class="number">
        <div class="bar">
            <!-- Les numéros de page seront ajoutés ici via JavaScript -->
        </div>
    </div>
    <div class="footer">
    <?php
        include('footer.html');
    ?>
    </div>
    <script>
        // Sélectionnez les éléments de menu déroulant
        const categorieSelect = document.getElementById("categorie");
        const typeProduitsSelect = document.getElementById("typeProduits");
        const tailleSelect = document.getElementById("taille");
        const prixSelect = document.getElementById("prix");

        // Options par catégorie
        const optionsParCategorie = {
            toutes: {
                typeProduits: ["Toutes les produits", "Vestes", "Pulls", "Tee-shirt", "Claquettes", "Running", "Baskets", "Lunettes de soleil", "Sac à dos"],
                taille: ["Toutes les tailles", "S", "M", "L", "XL", "2XL", "3XL", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            },
            vetements: {
                typeProduits: ["Tous les produits", "Vestes", "Pulls", "Tee-shirt"],
                taille: ["Toutes les tailles", "S", "M", "L", "XL", "2XL", "3XL"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            },
            chaussures: {
                typeProduits: ["Tous les produits", "Claquettes", "Running", "Baskets"],
                taille: ["Toutes les tailles", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            },
            accessoires: {
                typeProduits: ["Tous les produits", "Lunettes de soleil", "Sac à dos"],
                taille: ["-"],
                prix: ["Tous les prix", "- 20€", "20€ - 50€", "50€ - 100€", "+ 100€"]
            }
        };

        function mettreAJourOptions() {
            const categorieSelectionnee = categorieSelect.value;
            const options = optionsParCategorie[categorieSelectionnee] || { typeProduits: [], taille: [], prix: [] };

            typeProduitsSelect.innerHTML = "";
            tailleSelect.innerHTML = "";
            prixSelect.innerHTML = "";

            for (const typeProduit of options.typeProduits) {
                const nouvelElementOption = document.createElement("option");
                nouvelElementOption.value = typeProduit;
                nouvelElementOption.textContent = typeProduit;
                typeProduitsSelect.appendChild(nouvelElementOption);
            }

            for (const taille of options.taille) {
                const nouvelElementOption = document.createElement("option");
                nouvelElementOption.value = taille;
                nouvelElementOption.textContent = taille;
                tailleSelect.appendChild(nouvelElementOption);
            }

            for (const prix of options.prix) {
                const nouvelElementOption = document.createElement("option");
                nouvelElementOption.value = prix;
                nouvelElementOption.textContent = prix;
                prixSelect.appendChild(nouvelElementOption);
            }
        }

        // Écouteur d'événement pour la modification de la catégorie
        categorieSelect.addEventListener("change", mettreAJourOptions);

        // Appel initial pour mettre à jour les options
        mettreAJourOptions();



        // Numero de page
        // Sélectionnez l'élément avec la classe "bar"
        const bar = document.querySelector('.bar');

        const totalPages = 10; // Nombre total de pages
        const pagesToShow = 5; // Nombre de numéros de page à afficher simultanément
        let currentPage = 1; // Page actuelle

        function updatePageNumbers() {
            bar.innerHTML = "";

            // Calculez les numéros de page à afficher en fonction de la page actuelle
            const startPage = Math.max(1, currentPage - Math.floor(pagesToShow / 2));
            const endPage = Math.min(startPage + pagesToShow - 1, totalPages);

            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("a");
                pageButton.textContent = i;
                pageButton.className = "button hover-black";
                pageButton.href = "#";
                if (i === currentPage) {
                    pageButton.className = "button black";
                    pageButton.style.backgroundColor = "#000";
                    pageButton.style.color = "#fff";
                    pageButton.href = "";
                }
                pageButton.addEventListener("click", () => {
                    if (i !== currentPage) {
                        currentPage = i;
                        updatePageNumbers();
                    }
                });
                bar.appendChild(pageButton);
            }
            //page precedente
            if (currentPage > 1) {
                const prevButton = document.createElement("a");
                prevButton.innerHTML = "&laquo;";
                prevButton.className = "button hover-black";
                prevButton.href = "#";
                prevButton.addEventListener("click", () => {
                    currentPage--;
                    updatePageNumbers();
                });
                bar.insertBefore(prevButton, bar.firstChild);
            }
            // page suivante
            if (currentPage < totalPages) {
                const nextButton = document.createElement("a");
                nextButton.innerHTML = "&raquo;";
                nextButton.className = "button hover-black";
                nextButton.href = "#";
                nextButton.addEventListener("click", () => {
                    currentPage++;
                    updatePageNumbers();
                });
                bar.appendChild(nextButton);
            }
        }

        updatePageNumbers(); // Appel initial pour afficher les numéros de page

    </script>
</body>
</html>
