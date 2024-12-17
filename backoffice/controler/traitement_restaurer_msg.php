<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

if(isset($_POST['action'])){
    $messageExiste = recupListeMessagesSupprimer($pdo);
    $id_message = $_POST['id_messages'];

    if ($_POST['action'] == 'restaurerMsg') {

        if($messageExiste){

            restaureMessage($pdo, $id_message);
            
            header('Location:../public/index.php?page=15&sucess=ok');
            
        }else{
            var_dump($messageExiste) ;
            die();
            header('Location:../public/index.php?page=15&erreur=erreurAcceptation');
        }
    }else{
        header('Location:../public/index.php?page=15&erreur=erreurArchivation');
    }
}else{
    header('Location:../public/index.php?page=15&erreur=erreurAcceptation');
}


