// page catalogue avec les categories
<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/boutique.css">
    <title>Boutique</title>
</head>
<body>
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
</body>
</html>