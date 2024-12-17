<?php
session_start();
require '../model/connexion_bdd.php';
require '../model/fonctions.php';

    $id_produit = $_POST['idProd'];
    $produitExiste = recupFavoris($pdo,$_SESSION['idUser'], $id_produit,$deleted);
    if ($produitExiste) {
        header('location:../public/index.php?page=1&error=AjouterAuFavorisErreur'); 
    }else{
        $id_user = $_SESSION['idUser'];
        $id_produit = $_POST['idProd'];
        $deleted = 0;
        inserFavoris($pdo, $id_user, $id_produit, $deleted);
        header('location:../public/index.php?page=1&sucess=AjouterAuFavoris'); 
    }

