<?php 
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";


if(isset($_POST['action'])){
    $reductionExiste = listeBonreductionExistanteBdd($pdo);
    $id_bon= filter_input(INPUT_POST, 'id_bon', FILTER_SANITIZE_NUMBER_INT);
    if ($_POST['action'] == 'suprimerBon') {
        
        if($reductionExiste){
            supprimerBonReduction($pdo, $id_bon);
            header('Location:../public/index.php?page=11&sucess=suprimerAvecSuccess');
            
        }else{
            header('Location:../public/index.php?page=11&erreur=erreurSupression');
        }
    }else{
        header('../../public/index.php?page=11&erreur=erreurSupression');
    }
}else{
    header('../../public/index.php?page=11&erreur=erreurSupression');
}


