<?php
require "../model/connexion_bdd.php";

$recupCategMessage = recupCategMessage($pdo);
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
            <form class="mb-5" action="../controler/phpMailer.php" method="post" id="contactForm" name="contactForm">
                <div class="row">
                    <div class="col-md-6 form-group mb-5">
                        <label for="nomContact" class="col-form-label">Nom :</label>
                        <input type="text" class="form-control" name="nomContact" id="nomContact" placeholder="Votre nom">
                    </div>
                    <div class="col-md-6 form-group mb-5">
                        <label for="prenomContact" class="col-form-label">Prénom :</label>
                        <input type="text" class="form-control" name="prenomContact" id="prenomContact" placeholder="Votre prénom">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group mb-5">
                        <label for="mailContact" class="col-form-label">Email :</label>
                        <input type="text" class="form-control" name="mailContact" id="mailContact" placeholder="Votre Email">
                    </div>

                    <div class="col-md-12 form-group mb-3">
                        <label for="objetMail">Objet :</label>
                        <select name="objetMail" id="objetMail" class="form-select mt-2" aria-label="Default select example">
                            <option value="">Choisir L'objet du Message :</option>
                            <?php foreach ($recupCategMessage as $categMessage) { ?>
                                <option value="<?php echo $categMessage['objet_categ_message'] ?>"><?php echo $categMessage['objet_categ_message'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group mb-5">
                        <label for="msgMail" class="col-form-label">Message :</label>
                        <textarea class="form-control" name="msgMail" id="msgMail" cols="30" rows="4" placeholder="Votre message..."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group d-flex justify-content-end">
                        <input type="submit" name="Envoyer" value="Envoyer" class="btn-card btn-primary px-5">
                        <span class="submitting"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>