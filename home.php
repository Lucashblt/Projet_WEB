<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
    include("./affichageproduit.php") 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/home.css">
        <link rel="stylesheet" href="./styles/affichageproduit.css">
        <title>Accueil</title>
    </head>
    <body>
    <?php
        include('navbar.php');
    ?>
        <div class="acceuil">
            <h1> Bienvenue sur Woolify 
                <?php 
                    $queryPseudo = "SELECT pseudo FROM utilisateur WHERE email = '" . $SQLconn->loginStatus->userEmail . "'";
                    $result = $SQLconn->conn->query($queryPseudo);
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $pseudo = $row["pseudo"];
                        echo $pseudo;
                    }
                    ?>
            </h1>
            <br>
            <button  onclick="window.location.href ='boutique.php'"><span> J'en profite </span></button>
        </div>
        <div class="products">
            <?php
                echo createProductCard("Selfie", "./img/imgBDD/vetement1.jpg", ["Blanc", "Noir"], "50€");
                echo createProductCard("#Wolf", "./img/imgBDD/vetement2.jpg", ["Blue", "White", "Green"], "60€");
                echo createProductCard("Pull The North Face", "./img/imgBDD/vetement3.png", ["Violet"], "70€");
            ?>
        </div>
        <div class="Quality">
            <div class="column">
                <img src="./img/usine3-removebg-preview.png" alt="Made in France">
                <h3>Made in France</h3>
                <p>Nos produits sont fabriqués en France, dans notre propre usine située au cœur de la région textile. Notre engagement en faveur de la production locale nous permet de maintenir des normes de qualité élevées tout en soutenant l'économie locale. Chaque vêtement que nous fabriquons est le fruit d'un travail artisanal méticuleux.</p>
            </div>
            <div class="column">
                <img src="./img/recyclage-removebg-preview.png" alt="Recyclage">
                <h3>Matériaux recyclés</h3>
                <p>Nous sommes déterminés à minimiser notre impact sur l'environnement. Pour ce faire, nous utilisons principalement des matériaux recyclés dans la confection de nos vêtements. Notre engagement envers le recyclage réduit la demande de nouvelles matières premières, contribuant ainsi à la préservation de notre planète. Nous croyons en la mode durable.</p>
            </div>
            <div class="column">
                <img src="./img/couture-removebg-preview.png" alt="Couture">
                <h3>Couture de précision</h3>
                <p>Nous prenons la couture au sérieux. Chaque vêtement que nous fabriquons est le résultat d'une attention méticuleuse aux détails. Nos artisans couturiers possèdent une expertise inégalée, garantissant que chaque couture est parfaitement exécutée. La qualité est notre priorité, et c'est ce qui fait la différence dans chaque vêtement que nous créons.</p>
            </div>
        </div>

        <div class="products">
            <?php
                echo createProductCard("Nike x Carhart", "./img/imgBDD/chaussure1.jpg", ["Marron"], "150€");
                echo createProductCard("Nike Air", "./img/imgBDD/chaussure2.jpg", ["Blanc", "Jaune"], "100€");
                echo createProductCard("Timberland", "./img/imgBDD/chaussure3.jpg", ["Marron"], "180€")
            ?>
        </div>

        <div class="Avis">
            <div class="avis-item">
                <div class="avis-header">
                    <span class="user">Utilisateur 1</span>
                    <span class="rating">
                        <span class="stars">★★★☆☆</span>
                        <span class="note">3.0</span>
                    </span>
                </div>
                <p class="commentaire">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam sapien nec nisi vestibulum, etiam cursus nulla eu sapien volutpat. Nulla dapibus felis eu orci blandit.<br><i>Avis laissé pour le produit XYZ</i></p>
            </div>
            <div class="avis-item">
                <div class="avis-header">
                    <span class="user">Utilisateur 2</span>
                    <span class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="note">5.0</span>
                    </span>
                </div>
                <p class="commentaire">Sed aliquam sapien nec nisi vestibulum, etiam cursus nulla eu sapien volutpat. Sed aliquam sapien nec nisi vestibulum, etiam cursus nulla eu sapien volutpat.<br><i>Avis laissé pour le produit XYZ</i></p>
            </div>
        </div>
        <div class="footer">
        <?php
            include('footer.html');
        ?>
        </div>
    </body>
</html>
