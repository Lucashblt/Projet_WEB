<?php
    include "../initialize.php";
    include "../backend/functioncatalogue.php";

    if (isset($_POST['idCategorie']) && isset($_POST['nouveauNomCategorie'])) {
        $idCategorie = $_POST['idCategorie'];
        $nouveauNomCategorie = $_POST['nouveauNomCategorie'];

        updateNameCategorie($idCategorie, $nouveauNomCategorie);
    }
?>