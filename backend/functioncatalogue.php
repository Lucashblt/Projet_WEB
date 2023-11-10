<?php
    function deleteCategorie($idCategorie){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "DELETE FROM typesproduits WHERE idCategorie ='" . $idCategorie . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM typeproduit WHERE idCategorie = '" . $idCategorie . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM prixproduit WHERE idProduit = (SELECT idProduit FROM produits WHERE idCategorie = '" . $idCategorie . "')";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM avis WHERE idProduit = (SELECT idProduit FROM produits WHERE idCategorie = '" . $idCategorie . "') ";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM declinaisonproduit WHERE idProduit = (SELECT idProduit FROM produits WHERE idCategorie = '" . $idCategorie . "')";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM produit WHERE idCategorie = '" . $idCategorie . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM categorie WHERE idCategorie = '" . $idCategorie . "'";
        $result = $SQLconn->conn->query($query);

        
        if ($result){
            echo "La categorie a été supprimée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression de la categorie.";
        }
    }

    function updateNameCategorie($idCategorie, $nouveauNomCategorie){
        global $SQLconn; // Utilisez la connexion SQL

        // Mettez à jour le nom de la catégorie dans la base de données
        $query = "UPDATE categorie SET nom = '$nouveauNomCategorie' WHERE idCategorie = '$idCategorie'";
        $result = $SQLconn->conn->query($query);
    
        if ($result) {
            echo "Le nom de la catégorie a été mis à jour avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour du nom de la catégorie.";
        }
    }
?>