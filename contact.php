<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
     // FAQ avec les questions et les réponses
     $faq = array(
        "Q1: I’ve found the sneakers I want but can’t select my size" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q2: Can you give me more information about the sneakers?" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q3: Has my order been sent yet?" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q4: Can I track my order?" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q5: Part of my order is missing" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q6: You’ve sent me the wrong items" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q7: Which methods of payments can I use?" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q8: I forgot to use my discount code" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q9: Is it safe to order online?" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you.",
        "Q10: Delivery - How much is it and how long does it take?" => "I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. Feel free to drag and drop me anywhere you like on your page. I’m a great place for you to tell a story and let your users know a little more about you."
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
    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="#contact-info" class="active">Informations de Contact</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="contact-info" id="contact-info">
                <h1>Contactez-nous</h1>
                <h2>Informations de contact</h2>
                <p>Nom de l'entreprise : WOOLIFY</p>
                <p>Adresse : 123 Rue de l'Entreprise, Ville, Pays</p>
                <p>Téléphone : +33 123-456-7890</p>
                <p>Email : info@votreentreprise.com</p>
            </div>
            <div class="customer-service">
                <h2>Service Client</h2>
                <ul>
                    <li><strong>Horaires d'ouverture :</strong> Lundi au vendredi, 9h00 - 17h00</li>
                    <li><strong>Assistance par téléphone :</strong> +33 123-456-7890</li>
                    <li><strong>Assistance par email :</strong> support@votreentreprise.com</li>
                </ul>
            </div>

            <div class="faq" id="faq">
                <h2>FAQ - Foire aux questions</h2>
                <ul>
                    <?php
                    foreach ($faq as $question => $reponse) {
                        echo "<li><strong>$question</strong>: <br> $reponse</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
    <?php
            include('footer.html');
    ?>

</body>
</html>