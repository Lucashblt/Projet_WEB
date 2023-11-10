<?php
    function deleteProduit($idProduit){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "DELETE FROM prixproduit WHERE idProduit = '" . $idProduit . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM avis WHERE idProduit = '" . $idProduit . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM declinaisonproduit WHERE idProduit = '" . $idProduit . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM produit WHERE idProduit = '" . $idProduit . "'";
        $result = $SQLconn->conn->query($query);
            
        if ($result){
            echo "Le produit a été supprimée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du produit.";
        }
    }

    function updateNameProduit($idProduit, $nouveauNomProduit) {
        global $SQLconn;
    
        // Mettez à jour le nom du produit dans la base de données
        $query = "UPDATE produit SET nom = '$nouveauNomProduit' WHERE idProduit = '$idProduit'";
        $result = $SQLconn->conn->query($query);
    
        if ($result) {
            echo "Le nom du produit a été mis à jour avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour du nom du produit.";
        }
    }

    function insertProduit($nom, $description, $matiere, $idType, $prix, $couleurs, $stock, $imagePath, $idFournisseur){
        global $SQLconn; // Utilisez la connexion SQL

        
        $query = "SELECT c.idCategorie FROM categorie c 
                INNER JOIN typeproduit tp ON c.idCategorie = tp.idCategorie
                WHERE tp.idType = '$idType'";
        $result = $SQLconn->conn->query($query);
        $row = $result->fetch_assoc();
        $idCategorie = $row['idCategorie'];

        $query = "INSERT INTO produit (nom, description, matiereProduit, idCategorie, idType, photoProduit, idFournisseur)
                VALUES ('$nom', '$description', '$matiere', '$idCategorie', '$idType', '$imagePath', '$idFournisseur')";
        $result = $SQLconn->conn->query($query);
        
         $date = date("Y-m-d");
        if ($result) {
            $query = "INSERT INTO prixproduit (idProduit, dateDebut, prixNet, prixBrut) 
                    VALUES ((SELECT idProduit FROM produit WHERE nom = '$nom'),
                    $date,  '$prix' , '$prix')";
            $result = $SQLconn->conn->query($query);

            if ($result) {
                foreach($couleurs as $color){
                    $query = "INSERT INTO declinaisonproduit (idProduit, idTaille, idCouleur, Stock) 
                        VALUES ((SELECT idProduit FROM produit WHERE nom = '$nom'),
                        CROSS JOIN (SELECT idTaille FROM tailleproduit WHERE idType = '$idType',
                        CROSS JOIN (SELECT idCouleur FROM couleurproduit WHERE nom = '$color'), '$stock')";
                    $result = $SQLconn->conn->query($query);                
                }
                echo "Le produit a été ajouté avec succès.";
            } else {
                echo "Une erreur s'est produite lors de l'ajout du produit.";
            }
        } else {
            echo "Une erreur s'est produite lors de l'ajout du produit.";
        }
    }

?>