<?php
    //Initialise la constante ROOT et $SQLconn pour la BDD
    include("./initialize.php");
    include('navbar.php');
    // FAQ avec les questions et les réponses
    $faq = array(
        "Q1: J’ai trouvé les baskets que je veux, mais je ne peux pas sélectionner ma taille" => "Nous nous excusons pour le désagrément. Si vous ne parvenez pas à sélectionner votre taille, cela peut être dû à une rupture de stock ou à une erreur technique. Veuillez vérifier notre site ultérieurement ou contactez notre service client pour obtenir de l'aide.",
        "Q2: Pouvez-vous me fournir plus d'informations sur les baskets ?" => "Bien sûr, nous serions heureux de vous fournir plus d'informations. Veuillez consulter la page du produit pour obtenir les détails spécifiques. Si vous avez des questions supplémentaires, n'hésitez pas à contacter notre service client.",
        "Q3: Ma commande a-t-elle été expédiée ?" => "Pour vérifier l'état de votre commande et la date d'expédition, veuillez vous connecter à votre compte et accéder à la section 'Suivi de commande'. Vous y trouverez les informations les plus récentes sur votre commande.",
        "Q4: Puis-je suivre ma commande ?" => "Oui, vous pouvez suivre votre commande en utilisant le numéro de suivi fourni dans l'e-mail de confirmation de votre commande. Visitez notre page de suivi de commande et entrez ce numéro pour obtenir des mises à jour en temps réel sur l'emplacement de votre colis.",
        "Q5: Une partie de ma commande est manquante. Que faire ?" => "Nous sommes désolés pour cette erreur. Veuillez contacter notre service client dès que possible. Nous nous occuperons de la situation et ferons de notre mieux pour résoudre le problème rapidement.",
        "Q6: Vous m'avez envoyé les mauvais articles. Que faire ?" => "Nos excuses pour cette confusion. Veuillez contacter notre service client pour signaler l'erreur. Nous vous guiderons pour le retour des articles incorrects et vous enverrons les bons dès que possible.",
        "Q7: Quels modes de paiement puis-je utiliser ?" => "Nous acceptons plusieurs modes de paiement, y compris les cartes de crédit, les cartes de débit, les paiements par PayPal et d'autres options. Vous pouvez choisir le mode de paiement qui vous convient le mieux lors du processus de commande.",
        "Q8: J'ai oublié d'utiliser mon code de réduction." => "Si vous avez oublié d'appliquer un code de réduction lors de votre commande, veuillez contacter notre service client. Sous réserve de certaines conditions, nous pourrions être en mesure de vous aider à appliquer le code ou à vous offrir un remboursement partiel.",
        "Q9: Est-il sûr de commander en ligne ?" => "Nous prenons la sécurité très au sérieux. Notre site web utilise des mesures de sécurité avancées pour protéger vos informations personnelles. De plus, les paiements en ligne sont sécurisés. Soyez assuré que votre expérience de commande est sécurisée.",
        "Q10: Livraison - Combien coûte-t-elle et combien de temps prend-elle ?" => "Les frais de livraison et les délais de livraison varient en fonction de votre emplacement et du service de livraison que vous choisissez. Vous pouvez trouver des informations spécifiques sur les tarifs et les délais à la caisse lors de votre commande."
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
                <p>Email : contact@entreprise.com</p>
            </div>
            <div class="customer-service">
                <h2>Service Client</h2>
                <ul>
                    <li><strong>Horaires d'ouverture :</strong> Lundi au vendredi, 9h00 - 17h00</li>
                    <li><strong>Assistance par téléphone :</strong> +33 123-456-7890</li>
                    <li><strong>Assistance par email :</strong> support@entreprise.com</li>
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
            include('footer.php');
    ?>

</body>
</html>