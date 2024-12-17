<?php
session_start();
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

$id_bon = filter_input(INPUT_POST, 'id_bon', FILTER_SANITIZE_NUMBER_INT);
$nb_articles_min = filter_input(INPUT_POST, 'nbArticle', FILTER_SANITIZE_NUMBER_INT);
$taux = filter_input(INPUT_POST, 'tauxReduction', FILTER_SANITIZE_NUMBER_INT);
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];

$reductionExiste =  recupBonReductionId($pdo, $id_bon);

if($reductionExiste){
    $id_bon = $_POST['id_bon'];
    $reductionExiste = recupBonReductionId($pdo, $id_bon);
    updateBonReduction($pdo, $nb_articles_min, $taux, $date_debut, $date_fin, $id_bon);       
    header('Location:../public/index.php?page=11&sucess=prodMaj');
}

