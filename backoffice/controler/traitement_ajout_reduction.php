<?php
session_start();
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
date_default_timezone_set('Europe/Paris');

$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

$nb_articles_min = filter_input(INPUT_POST, 'nbArticle', FILTER_SANITIZE_NUMBER_INT);
// $taux = $_POST['tauxReduction'];
$taux = filter_input(INPUT_POST, 'tauxReduction', FILTER_SANITIZE_NUMBER_INT);

if ($date_debut < $date_fin) {
    $verifReductionExiste = reductionExistante($pdo, $date_debut, $date_fin);

    if ($verifReductionExiste) {

        header('Location:../public/index.php?page=11&erreur=reductionExistante');
    } else {
        // ici on appliquera la Fonction qui permet d'ajouter la réduction  \\
        insertReduction($pdo, $nb_articles_min, $taux, $date_debut, $date_fin);
        //  Ici on renvoi l'admin vers la page des réduction 
        header('Location:../public/index.php?page=11&success=reductionAppliquer');
    }
} else {
    // Ici on informe l'administrateur que la date du début doit être inferieur a la date de fin
    header('Location:../public/index.php?page=11&erreur=dateDebutSup');
}
