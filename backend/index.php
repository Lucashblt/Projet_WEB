<?php
    include "../initialize.php";
    $loggedIn = false;
    
    if ($SQLconn->loginStatus->loginSuccessful) {
        $loggedIn = true;
        
        $query ="SELECT role from utilisateur where email ='" . $SQLconn->loginStatus->userEmail . "'";
        $result = $SQLconn->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row["role"];
            if ($role == "Client") {  
                $redirect = "Location:../home.php";
                header($redirect);
            } else {
                $redirect = "Location:../backend/index.php";
            }
            
        }
    } else {
        $loggedIn = false;
    }
    
    
    if (isset($_POST["submit"])){
        $email = $_POST["email"];
        $query =" SELECT role from utilisateur where email ='" . $email . "'";    
        $result = $SQLconn->conn->query($query);
        if ($result && $result->num_rows > 0) {
            $loggedIn = true;
            $row = $result->fetch_assoc();
            $role = $row["role"];
            echo $role;
            if ($role == "Client") {    
                $redirect = "Location:../home.php";  
            } else {
                echo $role;
                $redirect = "Location:../backend/index.php"; 
            }
        }
        header($redirect);
    }
    
    
    $today = date('Y-m-d');

    $query = "SELECT SUM(total) AS totalVentesToday FROM commandes WHERE DATE(dateCommande) = '" . $today . "'";
    $result = $SQLconn->conn->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalVentes = $row["totalVentesToday"];
    }

    $query = "SELECT total, Status, dateCommande FROM commandes WHERE DATE(dateCommande) = '" . $today . "'";
    $result = $SQLconn->conn->query($query);
    if ($result && $result->num_rows > 0) {
        $commandes = $result->fetch_all(MYSQLI_ASSOC);
    }else{
        $commandes = NULL;
    }
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Page de Connexion</title>
        <link rel="stylesheet" href="../backend/styles/index.css">
    </head>
    <body>
        <section class="login-form">
            <h1>Bienvenue sur la page admin de WOOLIFY</h1>
            <p>Cette partie du site est réservée aux gérants.</p>
            
            <?php 
            if ($loggedIn == false): ?>
                <form action="index.php" method="post">
                    <label for="email">Email :</label>
                    <input type="text" id="email" name="email" required>

                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>

                    <input type="submit" name="submit" value="Se connecter">
                    <?php if (!empty($error)): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>
                </form>
        </section>

        <?php else : ?>
            <section class="gerant-info">
                <a href="inventaire_commandes.php">Voir toutes les commandes</a>
                <a href="gestion_catalogues.php">Gestion des catalogues</a>
                <a href="gestion_produit.php">Gestion des produits</a>
                <div>
                    <h3>Argent encaissé aujourd'hui</h3>
                    <p><?php echo htmlspecialchars($totalVentes); ?> €</p>
                </div>

                <div>
                    <h3>Commandes d'aujourd'hui</h3>
                    <ul>
                    <?php 
                        if ($commandes == NULL) {
                            echo "<li>Aucune commande aujourd'hui</li>";
                        } else {
                            foreach ($commandes as $commande){ ?>
                                <div>
                                    <li><?php echo $commande['dateCommande']; ?></li>
                                    <li><?php echo $commande['total']; ?> € </li>
                                    <li><?php echo $commande['Status']; ?></li>
                                </div>
                            <?php 
                            } 
                            ?>
                        <?php } ?>
                    </ul>
                </div>

            <form action="../logout.php" method="POST"> 
                <input type="hidden" value="logout" name="logout"></input>
                <button type="submit"><span>Se déconnecter</span></button>
            </form>
            </section>
        <?php endif; ?>
    </body>
</html>

