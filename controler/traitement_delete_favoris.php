<?php
session_start();
require '../model/connexion_bdd.php';
require '../model/fonctions.php';
if (isset($_SESSION['idUser'])) {
    $id_favoris = $_POST['idFavoris'];
    $id_produit = $_POST['idProduit'];
    recupFavorisUser($pdo, $_SESSION['idUser'], $id_produit);
   
    if ($_POST['action'] == 'suprimerFavoris') {
        deleteFavoris($pdo, $id_favoris, $_SESSION['idUser']);
        header('location:../public/index.php?page=11&success=SupprimerFavoris');
    } else {
        header('location:../public/index.php?page=11&error=ErreurSupressionFavoris'); 
    }
} else {
    header('location:../public/index.php?page=11&error=ErreurSupressionFavoris'); 
}
