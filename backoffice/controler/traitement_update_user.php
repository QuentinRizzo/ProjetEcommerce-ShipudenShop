<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$nom = $_POST['nomEditUser'];
$prenom = $_POST['prenomEditUser'];
$tel = $_POST['telEditUser'];
$mail = $_POST['mailEditUser'];
$adresse = $_POST['adresseEditUser'];
$id_role = $_POST['roleEditUser'];
$id_ville = $_POST['idVille'];
$id_user = $_POST['idUser'];
$userExiste = recupUtilisateur($pdo, $id_user);


if($userExiste){
    updateUser($pdo, $nom, $prenom, $mail, $tel, $id_role, $id_user);
    updateAdresseUser($pdo, $adresse, $id_ville, $id_user);
    header('Location:../public/index.php?page=3&sucess=UtilisateurMaj');
}else{
    header('Location:../public/index.php?page=3&success=ErreurMajUtilisateur');
}
