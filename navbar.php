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
                <li>
                    <div class="dropdown">
                        <a href="boutique.php">Boutique</a>
                        <div class="dropdown-content">
                            <a href="#">Vêtements</a>
                            <div class="menu_Vetements dropdown-submenu">
                                <a href="#">Vestes</a>
                                <a href="#">T-shirts</a>
                                <a href="#">Pulls</a>
                            </div>
                            <a href="#">Chaussures</a>
                            <div class="menu_Chaussures dropdown-submenu">
                                <a href="#">Baskets</a>
                                <a href="#">Running</a>
                                <a href="#">Tong</a>
                                <a href="#">Claquettes</a>
                            </div>
                            <a href="#">Accessoires</a>
                            <div class="menu_Accessoires dropdown-submenu">
                                <a href="#">Sac à dos</a>
                                <a href="#">Lunettes</a>
                            </div>
                        </div>
                    </div>
                </li>
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
    //menu hamburger
    menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
    });

    const loginModal = document.querySelector(".login");
    //hover sur MonCompte
    document.querySelector(".MonCompte").addEventListener('mouseenter', () => {
        loginModal.style.display = "block";
    });
    // Fermer la fenêtre modale lorsque la souris quitte MonCompte
    document.querySelector(".login").addEventListener('mouseleave', () => {
        loginModal.style.display = "none";
    });

    const openModalButton = document.querySelector(".open-modal")
    const modal = document.querySelector(".modal")
    const closeModalButton = document.querySelector(".close-modal")
    //modal login
    openModalButton.addEventListener('click', () => {
        modal.style.display = "block"
    })
    closeModalButton.addEventListener('click', () => {
        modal.style.display = "none"
    })
    
    // Sélectionnez tous les éléments de classe "dropdown-submenu"
    const submenus = document.querySelectorAll('.dropdown-submenu');

    // Ajoutez des gestionnaires d'événements pour chaque sous-menu
    submenus.forEach(submenu => {
        const parentItem = submenu.previousElementSibling; // Lien parent

        // Variable pour suivre si la souris est sur le sous-menu
        let isOnSubmenu = false;

        // Lorsque la souris entre dans le lien parent
        parentItem.addEventListener('mouseenter', () => {
            submenu.style.display = 'block';
        });
        // Lorsque la souris entre dans le sous-menu
        submenu.addEventListener('mouseenter', () => {
            submenu.style.display = 'block';
            isOnSubmenu = true;
        });
        // Lorsque la souris quitte à la fois le lien parent et le sous-menu
        parentItem.addEventListener('mouseleave', () => {
            if (!isOnSubmenu) {
                submenu.style.display = 'none';
            }
        });

        submenu.addEventListener('mouseleave', () => {
            isOnSubmenu = false;
            submenu.style.display = 'none';
        });
        /* // faire en sorte que lorsqu'il quitte le parentitem ou le submenu, le submenu disparaisse
        // Lorsque la souris quitte le sous-menu
        parentItem.addEventListener('mouseleave', () => {
            submenu.style.display = 'none';
        });
        */
    });

    // Sélectionnez tous les éléments de classe "dropdown"
    const dropdowns = document.querySelectorAll('.dropdown');

    // Ajoutez des gestionnaires d'événements pour chaque menu principal
    dropdowns.forEach(dropdown => {
        
        const submenu2 = dropdown.querySelector('.dropdown-submenu');
        // Fermez tous les sous-menus par défaut
        if (submenu2) {
            submenu2.style.display = 'none';
        }
        // Lorsque la souris quitte le menu principal
        dropdown.addEventListener('mouseleave', () => {
            const submenu = dropdown.querySelector('.dropdown-submenu');
            if (submenu) {
                submenu.style.display = 'none';
            }
        });
    });
    
</script>
</html>


