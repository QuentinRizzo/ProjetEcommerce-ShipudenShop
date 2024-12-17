<?php
require '../model/connexion_bdd.php';
require '../model/fonctions.php';

if (isset($_POST['btnsubmitmdpOublie1'])){
    $mail = $_POST['mail'];
    $userExiste =  verifUserExiste($pdo, $mail);

    // CONDITION NUMERO 1\\
    if($userExiste){
        // Vérifi si le token existe dans la bdd si il existe alors il sera supprimer
        $suprimeToken = suprimeToken($pdo, $userExiste['id_user']);
        // Generer un token aleatoire
        $token = bin2hex(random_bytes(16));
        // Definir le delais du token a 15 minutes
        $date_expiration = date("Y-m-d H: i :s", strtotime("+15 minutes"));
        // Insertion du token dans la bdd table token
        
        inserToken($pdo, $userExiste['id_user'], $token, $date_expiration);
        
        //Envoyer un email avec un lien cliquable (idUser et token en get dans le lien)
    
        $reset_link = "http://localhost/quentin/ShipudenShop/controler/traitement_mdp_oublier.php?token=" . $token . "&idUser=" . $userExiste['id_user'];

        //redirection vers la page form 1 (email) avec message en GET Un email vous a été envoyé….
        header('Location:' . $reset_link);
    }else{
        //Afficher message : Un email vous a été envoyé….(mais sans envoyer d’email)!
        header('location:../public/index.php?page=9&erreur=emailpastrouve');
    }

}


if (isset($_GET['idUser']) && isset($_GET['token'])){
    
    $id_user = filter_input(INPUT_GET, 'idUser', FILTER_SANITIZE_NUMBER_INT);
    $token = $_GET['token'];
    $date_expiration = date("Y-m-d H: i :s");
    // Verification si le token est valide ou non si il est valide alors
    // redirection vers form2
    $verifToken = verifTokenValide($pdo, $id_user, $token);
    

   if($verifToken){
    $heureActuel = strtotime($date_expiration);
    $heureExpiration = strtotime($verifToken['date_expiration']);
    
    if($heureExpiration > $heureActuel){
        //si la condition est respecter alors on redirige vers la page pour modifier le mdp
        header('location:../public/index.php?page=10&success=TokenValid&idUser'.$id_user);

    }else{
        // si ce n'ai pas respecter on redirige vers la page traitement avec un message d'erreur
        header('location:../public/index.php?page=9&erreur=LienExpirer');
    }

   }else{
    // si le lien est expirer on redirige vers le traitement avec en message lien expirer
        header('location:../public/index.php?page=9&erreur=LienExpirer');
   }
}

