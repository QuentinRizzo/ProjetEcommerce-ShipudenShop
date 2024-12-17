<?php
session_start();
require '../model/connexion_bdd.php';
require '../model/fonctions.php';

$mdpCorespond = recupMdp($pdo, $_SESSION['idUser'], $mdp);
$mdp = $_POST['mdpInscription'];
$nouvMdp = $_POST['mdpInscriptionNouv'];
$confirmationMdp = $_POST['mdpInscriptionConfirm'];

if (isset($_POST['mdpInscription'])) {
    if (password_verify($mdp, $mdpCorespond)) {
        if ($nouvMdp == $confirmationMdp) {

            $hashMdp = password_hash($nouvMdp, PASSWORD_DEFAULT);
            updatePassword($pdo, $hashMdp, $_SESSION['idUser']);
            session_destroy();
            header('location:../public/index.php');
        } else {
            echo 'Mot de passe incorrect';
        }
    }else{
        echo'Mdp Correspond pas';
    }
} else {
    echo 'error';
}
