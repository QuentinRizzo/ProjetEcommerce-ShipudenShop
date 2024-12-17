<?php
session_start();

require "../model/connexion_bdd.php";
require "../model/fonctions.php";

// Déclaration des Variables :
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
$confirmationMail = filter_input(INPUT_POST, 'mailConfirm', FILTER_SANITIZE_EMAIL);
$tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
$adresse = $_POST['adresse'];
$id_departement = $_POST['departement'];
$mdp = $_POST['mdpInscription'];
$confirmationMdp = $_POST['mdpInscriptionConfirm'];

// Récupération des villes \\
$ville = $_POST['ville']; // La valeur de $ville est de la forme suivante :  id_ville-cp
$tabville = explode('-', $ville); //explode fait la même chose que split en js il donne donc le résultat suivant : [id_ville, cp]
$id_ville = $tabville[0]; // premier element du tableau
$code_postal = $tabville[1]; // deuxième element du tableau


if($mdp == $confirmationMdp){
    $userExiste = verifUserExiste($pdo, $mail);

    if($userExiste){
        header('location:../public/index.php?erreur=emailExiste');
        
    }else{
        $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
        inserUser($pdo, $nom, $prenom, $mail, $tel, $hashMdp);
        $id_user = $pdo->lastInsertId();
        
        insertAdressUser($pdo, $adresse, $id_ville, $id_user);
        header('location:../public/index.php?sucess=compteCree');
    }
}else{
    header('location:../public/index.php?erreur=mdpConfirm');
}

