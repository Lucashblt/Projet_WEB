<?php
    include_once("functionpanier.php");

    // Si l'utilisateur est log crée un panier vide
    if ($SQLconn->loginStatus->loginSuccessful) {
        $loggedIn = true;
        demarrer_session();
        actualiser_session();
        createCart();
    } else {
        $loggedIn = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/navbar.css">
</head>
<body>
    <nav class="navbar">
        <a href="home.php" class="logo">WOOLIFY</a>
        <div class="nav-links">
            <ul>
                <li><a href="home.php">Accueil</a></li>
                <li>
                    <div class="dropdown">
                        <a href="boutique.php">Boutique</a>
                        <div class="dropdown-content">
                            <?php
                                $query = "SELECT nom FROM categorie";
                                $result = $SQLconn->conn->query($query);
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $nom = $row["nom"];
                                        echo '<a href="CatalogueProduit.php?categorie=' . urlencode($nom) . '">' . $nom . '</a>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                    // Si l'utilisateur est connecté (par exemple, le cookie de connexion est défini)
                    if ($loggedIn) {
                        echo '<li class="MonCompte"><a href="MonCompte.php">Mon Compte</a>
                                <!-- div panier et déconnexion -->
                                <div class="login">
                                    <button onclick="window.location.href = \'panier.php\'"><span>Mon Panier</span></button>
                                    <hr>
                                    <p>Vous nous quittez ?</p>
                                    <form action="./logout.php" method="POST"> 
                                        <input type="hidden" value="logout" name="logout"></input>
                                        <button type="submit"><span>Se déconnecter</span></button>
                                    </form>
                                </div>
                            </li>';
                    } else {
                        echo '<li class="MonCompte"><a href="#">Mon Compte</a>
                                <!-- div login si non connecté -->
                                <div class="login">
                                    <button class="open-modal"><span>Se connecter</span></button>
                                    <hr>
                                    <p>Vous n\'avez pas encore de compte ?</p>
                                    <button onclick="window.location.href = \'inscription.php\'"><span>S\'inscrire</span></button>
                                </div>
                            </li>';
                    }
                ?>
            </ul>
        </div>
        <img src="./img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
    </nav>
    <form action="#" method="post">
        <div class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <input type="text" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <button type="submit"><span>Connexion</span></button>
                <hr>
                <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
            </div>
        </div>
    </form>
<?php
	//If we reach here with an attempted login, it means it failed
	//So we display the error for the user to see
	if ( $SQLconn->loginStatus->loginAttempted ){
		echo '<h3 class="errorMessage">'.$SQLconn->loginStatus->errorText.'</h3>';
	}
?>
</body>
<script>
    //----------------------------------------------------------------------------
    //menu hamburger
    const menuHamburger = document.querySelector(".menu-hamburger")
    const navLinks = document.querySelector(".nav-links")
    //menu hamburger
    menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
    });
    //----------------------------------------------------------------------------

    //----------------------------------------------------------------------------
    //fenetre modale login pour se connecter et s'inscrire
    const loginModal = document.querySelector(".login");
    const MonCompte = loginModal.previousElementSibling;
    //hover sur MonCompte
    let IsOnLogin = false;
    let timeoutId;

    MonCompte.addEventListener('mouseenter', () => {
        loginModal.style.display = "block";
        timeoutId = setTimeout(() => {
            if (!IsOnLogin) {
                loginModal.style.display = "none";
            }
        }, 2000);
    });
    
    MonCompte.addEventListener('mouseleave', () => {
        clearTimeout(timeoutId);
    })

    loginModal.addEventListener('mouseenter', () => {
        IsOnLogin = true;
    });

    loginModal.addEventListener('mouseleave', () => {
        IsOnLogin = false;
        if (!IsOnLogin) {
            loginModal.style.display = "none";
        }
    });
    //----------------------------------------------------------------------------
    //fenetre openmodal pour se connecter
    //----------------------------------------------------------------------------
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
    //----------------------------------------------------------------------------
</script>
</html>


