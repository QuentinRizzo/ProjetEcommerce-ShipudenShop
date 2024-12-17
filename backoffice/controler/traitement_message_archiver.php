<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

if(isset($_POST['action'])){
    $messageExiste = recupListeMessages($pdo);
    $id_message = $_POST['id_messages'];

    if ($_POST['action'] == 'archiverMessage') {

        if($messageExiste){
            archiverMessage($pdo, $id_message);
            
            header('Location:../public/index.php?page=17&sucess=AccepterAvecSuccess');
            
        }else{
            header('Location:../public/index.php?page=17&erreur=erreurAcceptation');
        }
    }else{
        header('Location:../public/index.php?page=17&erreur=erreurArchivation');
    }
}else{
    header('Location:../public/index.php?page=17&erreur=erreurAcceptation');
}


