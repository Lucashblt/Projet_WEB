<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/navbar.css">
    <title>navbar</title>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo">WOOLIFY</a>
        <div class="nav-links">
            <ul>
                <li><a href="home.php">Accueil</a></li>
                <li><a href="#">Boutique</a></li>
                <li><a href="#">Panier</a></li>
                <li class="MonCompte"><a href="#">Mon Compte</a>
                    <div class="login">
                        <button class="open-modal"><span>se connecter</span></button>
                        <hr>
                        <p>Vous n'avez pas encore de compte ?</p>
                        <button onclick="window.location.href ='inscription.php'"><span>s'inscrire</span></button>
                    </div>
                </li>
            </ul>
        </div>
        <img src="./img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
    </nav>
    <form action="home.php" method="post">
        <div class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <input type="text" placeholder="E-mail">
                <input type="password" placeholder="Mot de passe">
                <button><span>Connexion</span></button>
            </div>
        </div>
    </form>
</body>
<script>
    const menuHamburger = document.querySelector(".menu-hamburger")
    const navLinks = document.querySelector(".nav-links")

    const loginModal = document.querySelector(".login");

    const openModalButton = document.querySelector(".open-modal")
    const modal = document.querySelector(".modal")
    const closeModalButton = document.querySelector(".close-modal")

    

    menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
    });


    document.querySelector(".MonCompte").addEventListener('mouseenter', () => {
        loginModal.style.display = "block";
    });
    document.addEventListener('click', (event) => {
    if (event.target !== openModalButton && event.target !== loginModal) {
        loginModal.style.display = "none";
    }
    });

    
    openModalButton.addEventListener('click', () => {
        modal.style.display = "block"
    })
    closeModalButton.addEventListener('click', () => {
        modal.style.display = "none"
    })
</script>
</html>


