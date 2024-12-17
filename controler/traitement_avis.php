<?php
session_start();
require '../model/connexion_bdd.php';
require '../model/fonctions.php';

if (isset($_SESSION['idUser'])) {
    $voteExiste = avisClient($pdo, $_SESSION['idUser']);
    date_default_timezone_set('Europe/Paris');
    $titre = $_POST['titreAvis'];
    $desc = $_POST['descAvis'];
    $notes = $_POST['noteClient'];
    $date = date('Y-m-d H:i:s');
    if ($voteExiste) {
        header('Location:../public/index.php?&erreur=AvisExistant');
    } else {
        insertAvisClient($pdo,$titre, $desc, $notes, $date, $_SESSION['idUser']);
        header('Location:../public/index.php?&sucess=AvisPublier');
    }
}else{
    header('Location:../public/index.php?&erreur=AvisNonPublier');
   
}
