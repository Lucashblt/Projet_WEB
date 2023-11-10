<?php
    function deleteCategorie($idCategorie){
        global $SQLconn; // Utilisez la connexion SQL

        $query = "DELETE FROM typeproduit WHERE idCategorie = '" . $idCategorie . "'";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM prixproduit WHERE idProduit = (SELECT idProduit FROM produit WHERE idCategorie = '" . $idCategorie . "')";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM avis WHERE idProduit = (SELECT idProduit FROM produit WHERE idCategorie = '" . $idCategorie . "') ";
        $result = $SQLconn->conn->query($query);

        $query = "DELETE FROM declinaisonproduit WHERE idProduit = (SELECT idProduit FROM produit WHERE idCategorie = '" . $idCategorie . "')";
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

    function updateNameCategorie($idCategorie, $nouveauNomCategorie) {
        global $SQLconn;
    
        // Mettez à jour le nom de la catégorie dans la base de données
        $query = "UPDATE categorie SET nom = '$nouveauNomCategorie' WHERE idCategorie = '$idCategorie'";
        $result = $SQLconn->conn->query($query);
    
        if ($result) {
            echo "Le nom de la catégorie a été mis à jour avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour du nom de la catégorie.";
        }
    }

    function uploadImage(){
        global $SQLconn; // Utilisez la connexion SQL

        $file = $_FILES['image']['name'];
        $path = pathinfo($file); //permet d'analyser le fichier et d'obtenir des choses comme son extension
        $ext = $path['extension'];


        $temp_name = $_FILES['image']['tmp_name'];
        $query = "SELECT idUtilisateur FROM utilisateur WHERE email = '" . $SQLconn->loginStatus->userEmail . "'";
        $result = $SQLconn->conn->query($query);
        $row = $result->fetch_assoc();
        $userID = $row['idUtilisateur'];

        $new_filename = $userID . "_".date("mdyHis");
        $path_filename_ext = "../img/imgBDD/" .$new_filename.".".$ext;

        if (file_exists($path_filename_ext)) {
            echo "Erreur lors de l'upload de l'image, l'image existe déjà.";
            return NULL;
        } else {
            move_uploaded_file($temp_name, $path_filename_ext);
            return $path_filename_ext;
        }
    }



    function insertCategorie($nomCategorie, $types, $pathimage){

        global $SQLconn; // Utilisez la connexion SQL

        $query = "INSERT INTO categorie (nom, photo) VALUES ('" . $nomCategorie . "', '" . $pathimage . "')";
        $result = $SQLconn->conn->query($query);
        if ($result) {
            $typesArray = explode(',', $types);
            foreach($typesArray as $type){
                $query = "INSERT INTO typeproduit (nom, idCategorie) VALUES ('" . $type . "', (SELECT idCategorie FROM categorie WHERE nom = '" . $nomCategorie . "'))";
                $result = $SQLconn->conn->query($query);
                if (!$result) {
                    echo "Une erreur s'est produite lors de l'ajout du type de produit.";
                }
            }
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la catégorie.";
        }
    }
?>