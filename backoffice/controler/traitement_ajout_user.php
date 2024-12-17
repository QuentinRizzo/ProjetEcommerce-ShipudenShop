<?php
// crée un formulaire de connexion par l'administrateur il doit y avoir un [FAIT]
//  select des roles pour que l'admin atribue un role pas de champ mdp [FAIT]
//  Crée  un token lien qui permet a l'utilisateur de changer sont mdp quand il a reçus le mail

require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

// Déclaration des Variables :
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = filter_input(INPUT_POST, 'mailConfirm', FILTER_SANITIZE_EMAIL);
$confirmationMail = filter_input(INPUT_POST, 'mailConfirm', FILTER_SANITIZE_EMAIL);
$tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
$adresse = $_POST['adresse'];

$id_departement = filter_input(INPUT_POST, 'departement', FILTER_SANITIZE_NUMBER_INT);



// Récupération des villes \\
$ville = $_POST['ville']; // La valeur de $ville est de la forme suivante :  id_ville-cp
$tabville = explode('-', $ville); //explode fait la même chose que split en js il donne donc le résultat suivant : [id_ville, cp]
$id_ville = $tabville[0]; // premier element du tableau
$code_postal = $tabville[1]; // deuxième element du tableau

$userExiste = verifUserExiste($pdo, $mail);

if ($userExiste){
    header('location:../public/index.php?page=3&erreur=emailExiste');
    
}else {
    // Faire générer le token ici 
    inserUser($pdo, $nom, $prenom, $mail, $tel);
    $id_user = $pdo->lastInsertId();
    insertAdressUser($pdo, $adresse, $id_ville, $id_user);
    header('location:../public/index.php?page=3&sucess=compteCree');
}
