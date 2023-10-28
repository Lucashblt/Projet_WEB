<?php
//Initialise la constante ROOT et $SQLconn pour la BDD
include("./initialize.php"); 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/home.css">
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
            <!-- 3 random products -->
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
            <div class="card">
                <div class="poster"><img src="https://images.unsplash.com/photo-1631167986287-1c3e6dd0597c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80" alt="Location Unknown"></div>
                <div class="details">
                    <h1>Nike</h1>
                    <div class="tags">
                        <span class="tag">White</span>
                        <span class="tag">Red</span>
                    </div>
                    <h2>100€</h2>
                </div>
            </div>
            <div class="card">
                <div class="poster"><img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2012&q=80" alt="Location Unknown"></div>
                <div class="details">
                    <h1>Nike x Carhartt</h1>
                    <div class="tags">
                        <span class="tag">Brown</span>
                    </div>
                    <h2>200€</h2>
                </div>
            </div>
            <div class="card">
                <div class="poster"><img src="https://images.unsplash.com/photo-1595909236612-9fd30b476365?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80" alt="Location Unknown"></div>
                <div class="details">
                    <h1>Nike Jordan</h1>
                    <div class="tags">
                        <span class="tag">Yellow and black</span>
                    </div>
                    <h2>120€</h2>
                </div>
            </div>
        </div>

        <div class="Avis">
            <div class="avis-item">
                <div class="avis-header">
                    <span class="user">Utilisateur 1</span>
                    <span class="rating">
                        <span class="stars">★★★★☆☆</span>
                        <span class="note">4.0</span>
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
