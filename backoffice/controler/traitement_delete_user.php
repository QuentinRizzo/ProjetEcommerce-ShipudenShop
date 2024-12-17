<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

if(isset($_POST['action'])){
    $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
    $userExiste = recupUtilisateur($pdo, $id_user);
   

    if ($_POST['action'] == 'suprimerUser'){

        if($userExiste){
            supprimerUser($pdo, $id_user);
            header('Location:../public/index.php?page=3&sucess=suprimerAvecSuccess');
        }else{
            header('Location:../public/index.php?page=3&erreur=erreurSupression');
        }
    }else{
        header('../../public/index.php?page=3&erreur=erreurSupression');
    }
}else{
    header('../../public/index.php?page=3&erreur=erreurSupression');
}
