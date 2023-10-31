<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
     // FAQ avec les questions et les réponses
     $faq = array(
        "Question 1" => "Réponse à la question 1",
        "Question 2" => "Réponse à la question 2",
        "Question 3" => "Réponse à la question 3",
        "Question 4" => "Réponse à la question 4",
        "Question 5" => "Réponse à la question 5",
        "Question 6" => "Réponse à la question 6",
        "Question 7" => "Réponse à la question 7",
        "Question 8" => "Réponse à la question 8",
        "Question 9" => "Réponse à la question 9",
        "Question 10" => "Réponse à la question 10",
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/contact.css">
    <title>Contact</title>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <h1>Contactez-nous</h1>

    <h2>Informations de contact</h2>
    <p>Nom de l'entreprise : WOOLIFY</p>
    <p>Adresse : 123 Rue de l'Entreprise, Ville, Pays</p>
    <p>Téléphone : +33 123-456-7890</p>
    <p>Email : info@votreentreprise.com</p>

    <h2>FAQ - Foire aux questions</h2>
    <ul>
        <?php
        foreach ($faq as $question => $reponse) {
            echo "<li><strong>$question</strong>: $reponse</li>";
        }
        ?>
    </ul>
    
    <?php
            include('footer.html');
    ?>

</body>
</html>