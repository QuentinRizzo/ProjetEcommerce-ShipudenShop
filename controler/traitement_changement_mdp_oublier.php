<?php
require '../model/connexion_bdd.php';
require '../model/fonctions.php';

$nouvMdp = $_POST['nouvMdp'];
$nouvMdpConfirm = $_POST['mdpConfirm'];
$id_user = filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_NUMBER_INT);

// Verification si nouvMdp == nouvMdpConfirm

if ($nouvMdp == $nouvMdpConfirm) {

    $hashMdp = password_hash($nouvMdp, PASSWORD_DEFAULT);
    updatePassword($pdo, $hashMdp, $id_user);
    suprimeToken($pdo, $id_user);
    header('location:../public/index.php?&success=MdpModifier');
} else {
    header('location:../public/index.php?page=10&erreur=PasIdentique');
}
