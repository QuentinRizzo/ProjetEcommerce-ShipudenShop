<?php
session_start();
//Importez les classes PHPMailer dans l'espace de noms global 
//Celles-ci doivent être en haut de votre script, pas à l'intérieur d'une fonction 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../model/connexion_bdd.php";
require "../model/fonctions.php";
require '../vendor/autoload.php';

// Ajout de l'instanciation de PHPMailer
if(isset($_SESSION['idUser'])){
    if(isset($_POST['Envoyer'])){
        $nomContact = htmlentities($_POST['nomContact']);
        $prenomContact = htmlentities($_POST['prenomContact']);
        $mailContact = htmlentities($_POST['mailContact']);
        $objetMail = $_POST['objetMail'];
        $msgMail = htmlentities($_POST['msgMail']);
        $status = 'EnAttente';
        // ============================================== \\
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'revoriadeveloppement@gmail.com'; //pour générer le mdp https://myaccount.google.com/u/2/apppasswords?pli=1&rapt=AEjHL4OfqNuU7GFeDQgPxS_GMrPpOUdj6d40h-MT9f0jm-n_kasrcGKMyap2tFJ6cXmoJIRIxaGjKodNVv0jOWASD204AapQwod-lid0Uv6IHEaI27FByaE
        $mail->Password = 'edsycwsiawjhnilk ';// enlever les espaces du mdp
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->setFrom($mailContact, $nomContact);
        $mail->addAddress('revoriadeveloppement@gmail.com');
        $mail->Subject = ("$mailContact ($objetMail)");
        $mail->Body = $msgMail;
        $mail->send();
        
        insertMessageEnvoyer($pdo,$nomContact,  $prenomContact, $mailContact, $objetMail, $msgMail, $_SESSION['idUser'], $status);
        header('Location:../public/index.php?page=3&sucess=MsgEnvoyer');
    }else{
        header('Location:../public/index.php?page=3&erreur=ErreurEnvoiMsg');
    }
}
?>
