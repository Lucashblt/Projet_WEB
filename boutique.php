<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./styles/boutique.css">
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <div class="filtres">
        <form action="boutique.php" method="post">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie">
                <option value="">Toutes les catégories</option>
                <option value="pulls">Pulls</option>
                <option value="tee-shirt">Tee-shirt</option>
                <option value="chaussures">Chaussures</option>
            </select>

        </form>
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
