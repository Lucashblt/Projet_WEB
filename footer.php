<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/footer.css">
    <title>Footer</title>
</head>
<bocy>
    <footer>
        <div class="contact">
            <h2>Contactez-nous</h2>
            <p>Email : contact@entreprise.com</p>
            <p>Téléphone : +33 123 456 789</p>
            <p>Adresse : 123 Rue de l'Entreprise, Ville</p>
        </div>
        <div class="reseaux-sociaux">
            <h2>Suivez-nous</h2>
            <a href="contact.php" class="social-icon"><img src="./img/facebook.png" alt="Facebook"></a>
            <a href="contact.php" class="social-icon"><img src="./img/twitter.png" alt="Twitter"></a>
            <a href="contact.php" class="social-icon"><img src="./img/instagram.jpg" alt="Instagram"></a>
            <a href="contact.php" class="social-icon"><img src="./img/tiktok.png" alt="Tiktok"></a>
        </div>
    </footer>
    <?php
        $SQLconn->DisconnectDatabase();
    ?>
</bocy>
</html>