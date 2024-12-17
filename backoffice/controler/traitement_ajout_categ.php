<?php 
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$nom_categorie = $_POST['nomCateg'];
$categExiste = categExistante($pdo, $nom_categorie);

if($categExiste){
    header('Location:../public/index.php?page=14&erreur=CategExiste');
}else{
    insertCateg($pdo, $nom_categorie);
    header('Location:../public/index.php?page=14&success=InsertCategSuccess');
}

?>

