<?php
    function insertAvis($idProduit){
        $creationAttempted = false;
        $creationSuccessful = false;
        $error = NULL;

        global $SQLconn; // Utilisez la connexion SQL

        if (isset($_POST["note"]) && isset($_POST["comment"])) {
            $creationAttempted = true;
            $avisNote = $SQLconn->SecurizeString_ForSQL($_POST["note"]);
            $avisCommentaire =$SQLconn->SecurizeString_ForSQL($_POST["comment"]);
    
            // Requête SQL avec les valeurs échappées
            $query = "INSERT INTO avis (idUtilisateur, idProduit, note, avis) 
                      VALUES ((SELECT idUtilisateur FROM utilisateur WHERE email = '" . $SQLconn->loginStatus->userEmail . "'), $idProduit, $avisNote, '$avisCommentaire')";
    
            // Exécutez la requête SQL
            if ($SQLconn->query($query)) {
                $creationSuccessful = true;
            } else {
                $error = "Erreur lors de l'insertion de l'avis" ;
            }
        }
        //On crée un tableau associatif contenant les informations à retourner
		$returnArray = ['attempted' => $creationAttempted, 
                        'success' => $creationSuccessful, 
                        'error' => $error ];

        return $returnArray;
    }

    function getAvis(){
        global $SQLconn; // Utilisez la connexion SQL

        // Requête SQL pour récupérer toutes les catégories
        $query = "SELECT a.note AS noteAvis, a.avis AS Avis, p.nom AS nomProduit, 
                GROUP_CONCAT(DISTINCT u.pseudo ORDER BY u.pseudo ASC) AS nomUtilisateur
                    FROM avis a
                    LEFT JOIN utilisateur u ON a.idUtilisateur = u.idUtilisateur
                    LEFT JOIN produit p ON a.idProduit = p.idProduit
                    GROUP BY u.pseudo
                    ORDER BY RAND()
                    LIMIT 2";

        // Exécutez la requête SQL
        $result = $SQLconn->query($query);

        // Récupérez les résultats dans un tableau associatif
        $avis = $result->fetch_all(MYSQLI_ASSOC);

        return $avis;
    }

    function getAvisWithIdProduit($idProduit){
        global $SQLconn; // Utilisez la connexion SQL

        // Requête SQL pour récupérer toutes les catégories
        $query = "SELECT a.note AS noteAvis, a.avis AS Avis, a.idProduit AS produitAvis, GROUP_CONCAT(DISTINCT u.pseudo ORDER BY u.pseudo ASC) AS nomUtilisateur
                    FROM avis a
                    LEFT JOIN utilisateur u ON a.idUtilisateur = u.idUtilisateur
                    WHERE a.idProduit = $idProduit
                    GROUP BY u.pseudo
                    ORDER BY RAND()
                    LIMIT 2";

        // Exécutez la requête SQL
        $result = $SQLconn->query($query);

        // Récupérez les résultats dans un tableau associatif
        $avis = $result->fetch_all(MYSQLI_ASSOC);

        return $avis;
    }
    
    // Fonction pour générer les étoiles pleines et vides
    function generateStars($note) {
        $fullStars = intval($note); // Nombre d'étoiles pleines
        $emptyStars = 5 - $fullStars; // Nombre d'étoiles vides
        $starsHTML = str_repeat('★', $fullStars) . str_repeat('☆', $emptyStars);
        return $starsHTML;
    }
    
?>