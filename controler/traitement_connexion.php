<?php
session_start();
require "../model/connexion_bdd.php";
require "../model/fonctions.php";

$mail = $_POST['mail'];
$mdp = $_POST['mdpConnexion'];
$userExiste = verifUserExiste($pdo, $mail);

if($userExiste){
    if(password_verify($mdp, $userExiste['mdp'])){
        $_SESSION['idUser'] = $userExiste['id_user'];
        $_SESSION['idRoleUser'] = $userExiste['id_role'];

        header('location:../public/index.php?sucess=connexionSuccess'); 
    }else{
        header('location:../public/index.php?&erreur=identifiants');
    }
}else{
    header('location:..public/index.php?page=2&erreur=identifiants');
}
