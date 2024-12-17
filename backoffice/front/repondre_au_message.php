<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
if(isset($_SESSION['idUser'])){
    $userExiste = recupUtilisateur($pdo, $_SESSION['idUser']);
    $id_message = $_POST['id_messages'];
    $messageExiste = recupInfosMessage($pdo, $id_message);
?>
<div class="container mt-5">
    <div class="row mx-auto">
        <?php
        if (isset($_GET['sucess'])) {

            if ($_GET['sucess'] == 'MsgEnvoyer') {
                echo '<p class="text-success text-center">Le Message à été envoyer avec succès ! </p>';
            }
        }
        if (isset($_GET['erreur'])) {

            if ($_GET['erreur'] == 'ErreurEnvoiMsg') {
                echo '<p class="Error text-center text-danger">Un Soucis est survenu Veuillez Réesayer ! </p>';
            }
        }
        ?>
        <div class="form h-100 feuille-contact">
            <h3 class="text-center mb-5 mt-5">Nous Contacter</h3>
            <form class="mb-5" action="../controler/traitement_rep_message.php" method="post" id="contactForm" name="contactForm">
                <div class="row">
                    <div class="col-md-6 form-group mb-5">
                        <label for="nomContact" class="col-form-label">Nom :</label>
                        <input type="text" class="form-control" name="nomContact" id="nomContact" value="<?php echo $userExiste['nom'] ?>">
                    </div>
                    <div class="col-md-6 form-group mb-5">
                        <label for="prenomContact" class="col-form-label">Prénom :</label>
                        <input type="text" class="form-control" name="prenomContact" id="prenomContact" value="<?php echo $userExiste['prenom'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group mb-5">
                        <label for="mailContact" class="col-form-label">Email :</label>
                        <input type="text" class="form-control" name="mailContact" id="mailContact" value="<?php echo $userExiste['mail'] ?>">
                    </div>

                    <div class="col-md-12 form-group mb-3">
                        <label for="objetMail">Objet :</label>
                        <input type="text" class="form-control" name="objetMail" id="objetMail" value="Re: <?php echo $messageExiste['objet_message'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group mb-5">
                        <label for="msgMail" class="col-form-label">Vôtre Réponse :</label>
                        <textarea class="form-control" name="msgMail" id="msgMail" cols="30" rows="4" placeholder="Vôtre réponse ici ..."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group d-flex justify-content-end">
                        <input type="hidden" name="MailEnvoyeur" value="<?php echo $messageExiste['mail_envoyeur'] ?>">
                        <input type="submit" name="Envoyer" value="Envoyer" class="btn-card btn-primary px-5">
                        <span class="submitting"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }?>