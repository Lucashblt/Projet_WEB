<?php
    function demarrer_session(){
        session_start();
        $_SESSION['time'] = time();
    }
    function actualiser_session()
    {
        if ( isset($_SESSION['time']) ) {// Test: Si il existe une session
        
            $tempsMaxSession = 3600;                            
            // le temps maximal que dure la session en seconde
        }
        if( ($_SESSION['time'] + $tempsMaxSession) >= time() ) {   
        // Si l'action sur la session date de moins de $tempsMaxSession
            $_SESSION['time'] = time();            // Session reactialisé
        }else{                                       // Sinon
            session_destroy();                 // Session detruite
        }
    }

    function createCart(){
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['idDeclinaison'] = array();
            $_SESSION['panier']['selectedQuantity'] = array();
            $_SESSION['panier']['idPrix'] = array();
         }
        return true;
    }

    function addProduct($idDeclinaison, $selectedQuantity, $idPrix) {
        // Si le panier existe
        //echo "addProduct 1";
        if (createCart()) {
            // Vérifiez si le produit existe déjà dans le panier
            //echo "addProduct 2";
            if (in_array($idDeclinaison, $_SESSION['panier']['idDeclinaison'])) {
                // Si le produit existe déjà, trouvez sa position
                $positionProduit = array_search($idDeclinaison, $_SESSION['panier']['idDeclinaison']);
    
                // Ajoutez la quantité sélectionnée au produit existant
                $_SESSION['panier']['selectedQuantity'][$positionProduit] += $selectedQuantity;
            } else {
                // Sinon, ajoutez le produit au panier
                //echo "addProduct 3.5";
                array_push($_SESSION['panier']['idDeclinaison'], $idDeclinaison);
                array_push($_SESSION['panier']['selectedQuantity'], $selectedQuantity);
                array_push($_SESSION['panier']['idPrix'], $idPrix);
                //var_dump($_SESSION);
            }
        } else {
            echo "Un problème est survenu.";
        }
    }
    


    function updateQuantiteProduct($idDeclinaison, $selectedQuantity){
        //Si le panier existe
        if (createCart()) {
            //Si la quantité est positive on modifie sinon on supprime l'article
            if ($selectedQuantity > 0) {
                
                $_SESSION['panier']['selectedQuantity'][$idDeclinaison] = $selectedQuantity ;

            }else{
                deleteProduct($idDeclinaison);

            }
        }else{
            echo "Un problème est survenu.";
        }
    }


    function deleteProduct($idDeclinaison){
        //Si le panier existe
        if (createCart()){
            if(countProduct() <= 1){
                deleteCart();
            }else{
                //Nous allons passer par un panier temporaire
                $tmp=array();
                $tmp['idDeclinaison'] = array();
                $tmp['selectedQuantity'] = array();
                $tmp['idPrix'] = array();

                for($i = 0; $i < count($_SESSION['panier']['idDeclinaison']); $i++)
                {

                    if ($i != $idDeclinaison)
                    {
                        array_push( $tmp['idDeclinaison'],$_SESSION['panier']['idDeclinaison'][$i]);
                        array_push( $tmp['selectedQuantity'],$_SESSION['panier']['selectedQuantity'][$i]);
                        array_push( $tmp['idPrix'],$_SESSION['panier']['idPrix'][$i]);
                    }

                }
                //On remplace le panier en session par notre panier temporaire à jour
                $_SESSION['panier'] =  $tmp;
                //On efface notre panier temporaire
                unset($tmp);
            }
            
        }else{
            echo "Un problème est survenu .";
        }
            
    }
    function getPriceById($idPrix){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "SELECT prixNet FROM prixproduit WHERE idPrix = '".$idPrix."'";
        $result = $SQLconn->conn->query($query);
        if ( $result->num_rows != 0 ){
            $row = $result->fetch_assoc();
            return $row["prixNet"];
        }
        else {
            return 0;
        }
    }

    function getDeclinaisonProduct($taille, $couleur, $idProduit){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "SELECT dp.idDeclinaison 
                FROM declinaisonproduit dp
                INNER JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
                INNER JOIN tailleproduit tap ON dp.idTaille=tap.idTaille
                WHERE dp.idProduit = $idProduit AND tap.taille = '$taille' AND cp.nom = '$couleur' ";

        $result = $SQLconn->conn->query($query);
        if ( $result->num_rows != 0 ){
            $row = $result->fetch_assoc();
            return $row["idDeclinaison"];
        }
        else {
            return 0;
        }
    }

    function getIdprixByIdproduit($idProduit){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "SELECT idPrix from prixproduit where idProduit = $idProduit AND CURRENT_DATE() BETWEEN dateDebut AND dateFin";
        $result = $SQLconn->conn->query($query);
        if ( $result->num_rows != 0 ){
            $row = $result->fetch_assoc();
            return $row["idPrix"];
        }
        else {
            return 0;
        }
    }

    function getInfoProductByIdeclinaison($idDeclinaison){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "SELECT dp.idProduit AS idProduit, tap.taille AS nomTaille, cp.nom AS nomCouleur, 
        p.nom AS nomProduit, p.photoProduit AS photoProduit 
            FROM declinaisonproduit dp
            INNER JOIN couleurproduit cp ON dp.idCouleur = cp.idCouleur
            INNER JOIN tailleproduit tap ON dp.idTaille=tap.idTaille
            INNER JOIN produit p ON dp.idProduit = p.idProduit
            WHERE dp.idDeclinaison = $idDeclinaison";
        
        
        $result = $SQLconn->conn->query($query);
        if ( $result->num_rows != 0 ){
            $products = $result->fetch_all(MYSQLI_ASSOC);
            return $products;
        }
        else {
            return 0;
        }
    }

    function insertCommande($total){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "INSERT INTO commandes(idUtilisateur, total)
                VALUES (
                (SELECT idUtilisateur FROM utilisateur WHERE email = '" . $SQLconn->loginStatus->userEmail . "'),
                $total)";

        if ($SQLconn->query($query)) {
            $lastCommandId = $SQLconn->conn->insert_id;
            insertCommandesLignes($lastCommandId);
            echo '<h3 class="successMessage">Commande effectuée avec succès</h3>';
        } else {
            echo '<h3 class="errorMessage">Erreur lors de l insertion de la commande</h3>';
        }
    }
    function insertCommandesLignes($idCommande){
        global $SQLconn; // Utilisez la connexion SQL

        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier']['idDeclinaison'] as $key => $idDeclinaison) {
                $idPrix = $_SESSION['panier']['idPrix'][$key];
                $quantite = $_SESSION['panier']['selectedQuantity'][$key];
    
                $query = "INSERT INTO commandeslignes(idCommande, idDeclinaison, idPrix, quantite)
                        VALUES ($idCommande, $idDeclinaison, $idPrix, $quantite)";
    
                if ($SQLconn->query($query)) {
                    //echo '<h3 class="successMessage">Ligne de commande ajoutée avec succès</h3>';
                } else {
                    //echo '<h3 class="errorMessage">Erreur lors de l\'insertion de la ligne de commande</h3>';
                }
            }
        }
    }


    function deleteCart(){
        unset($_SESSION['panier']);
    }


    function countProduct(){
        if (isset($_SESSION['panier'])) {
            return array_sum($_SESSION['panier']['selectedQuantity']);
        } else {
            return 0;
        }
    }

?>