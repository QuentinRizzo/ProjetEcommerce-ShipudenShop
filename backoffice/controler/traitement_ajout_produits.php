<?php
session_start();
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

// Ajout de produit \\


$titre = $_POST['titre-figurine'];
$materiel = $_POST['materiel-figurine'];
$taille = filter_input(INPUT_POST, 'taille-figurine', FILTER_SANITIZE_NUMBER_FLOAT);
$description = $_POST['desc-figurine'];
$prix_unit = filter_input(INPUT_POST, 'prix-unite-figurine', FILTER_SANITIZE_NUMBER_INT);
// $id_categorie = $_POST['categ-figurine'];
$id_categorie = filter_input(INPUT_POST, 'categ-figurine', FILTER_SANITIZE_NUMBER_INT);
$deleted = 0;
$stock = 1;
$figurineExiste = figurineExistante($pdo, $titre);

if($figurineExiste){
        header('Location:../public/index.php?page=2&erreur=FigurineExiste');
}else{
    
     // Uploadé une image

     if(isset($_FILES['logo']) && $_FILES['logo']['name'] != '') {
         $extensions_valides = array('jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG','webp','WEBP'); // les extensions acceptées
    
         $extension_upload = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION); // récup de l'extension
    
         if(in_array($extension_upload, $extensions_valides)) { // si l'extension est bonne
             $dossier = '../../public/ressource/figurines';
             $nom_img = time();
             $nom_img = $nom_img.'.'.$extension_upload;
             $chemin = $dossier."/".$nom_img;
             $publication = date('d-m-y h:i:s');
    
             if(move_uploaded_file($_FILES['logo']['tmp_name'], $chemin)) {
                
                 // Inseret le produit en bdd
                 insertFigurine($pdo, $titre, $materiel, $taille, $description, $prix_unit, $nom_img, $stock , $id_categorie, $deleted);

                 $id_produit = $pdo->lastInsertId();
                 // inseret les images en bdd
                 insertImg($pdo, $nom_img, $publication, $id_produit);

                 // Redirection
                 header('Location:../public/index.php?page=2&sucess=ok');

             }else{
                 // Erreur d'upload
                 header('Location:../public/index.php?page=5&erreur=erreurUpload');
             }
         }else{
             // Votre fichier n'est pas valide
             header('Location:../public/index.php?page=5&erreur=fichierInvalide');
         }
     }else{
         // aucun fichier à télécharger
         header('Location:../public/index.php?page=5&erreur=aucunFichier');
     }
 }
