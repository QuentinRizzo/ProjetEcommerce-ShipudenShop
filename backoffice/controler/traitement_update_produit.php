<?php
session_start();
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

$id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_SANITIZE_NUMBER_INT);
$produitExiste = recupProduits($pdo, $id_produit);
$imgExiste = recupImg($pdo);

if ($produitExiste) {
    if (isset($_FILES['logo']) && $_FILES['logo']['name'] != '') {
        $extensions_valides = array('jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG', 'webp', 'WEBP'); // les extensions acceptées

        $extension_upload = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION); // récup de l'extension

        if (in_array($extension_upload, $extensions_valides)) { // si l'extension est bonne
            $dossier = '../../public/ressource/figurines';
            $nom_img = time();
            $nom_img = $nom_img . '.' . $extension_upload;
            $chemin = $dossier . "/" . $nom_img;
            
            $publication = date('d-m-y h:i:s');

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $chemin)) {

                $titre = $_POST['titreEdit'];
                $materiel = $_POST['materielEdit'];
                $taille = filter_input(INPUT_POST, 'tailleEdit', FILTER_SANITIZE_NUMBER_INT);
                $description = $_POST['descEdit'];
                $prix_unit = filter_input(INPUT_POST, 'prix_unitEdit', FILTER_SANITIZE_NUMBER_FLOAT);;
                $logo = $_FILES['logo'];
                $stock = filter_input(INPUT_POST, 'stockEdit', FILTER_SANITIZE_NUMBER_INT);
                $id_categorie = filter_input(INPUT_POST, 'categEdit', FILTER_SANITIZE_NUMBER_INT);
                $id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_SANITIZE_NUMBER_INT);

                updateStockFigurine($pdo, $titre, $materiel, $taille, $description, $prix_unit, $nom_img, $stock, $id_categorie, $id_produit);
                
                updateImg($pdo, $nom_img, $publication, $id_produit);
                header('Location:../public/index.php?page=2&sucess=prodMaj');
            } else {
                // Erreur d'upload
                header('Location:../public/index.php?page=2&erreur=erreurUpload');
            }
        } else {
            // Votre fichier n'est pas valide
            header('Location:../public/index.php?page=2&erreur=fichierInvalide');
        }
    } else {
        // aucun fichier à télécharger
        header('Location:../public/index.php?page=2&erreur=aucunFichier');
    }
}else{
    header('Location:../public/index.php?page=2&erreur=erreurMaj');
}
