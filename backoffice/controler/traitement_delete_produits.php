<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

if(isset($_POST['action'])){
    $produitExiste = recupListeProduits($pdo);
    $id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_SANITIZE_NUMBER_INT);
    
    if ($_POST['action'] == 'suprimerProduit') {
        
        if($produitExiste){
            suprimerProduit($pdo, $id_produit);
            header('Location:../public/index.php?page=2&sucess=suprimerAvecSuccess');
            
        }else{
            header('Location:../public/index.php?page=2&erreur=erreurSupression');
        }
    }else{
        header('../../public/index.php?page=2&erreur=erreurSupression');
    }
}else{
    header('../../public/index.php?page=2&erreur=erreurSupression');
}


