<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 feuille-contact w-100 mt-5 mb-5" id="mdpToogle">
            <h3 class="text-center mb-5 mt-5">Nouveaux mot de passe</h3>
            <form class="mb-5" method="post" action="../controler/traitement_changement_mdp_oublier.php" id="form3-mdp">
                <?php
                if (isset($_GET['sucess'])) {

                    if ($_GET['sucess'] == 'mdpReinitialiser') {
                        echo '<p class="success">Mot de passe réinitialiser avec succès ! </p>';
                    }
                }


                if (isset($_GET['error'])) {

                    if ($_GET['erreur'] == 'erreurreset') {
                        echo '<p class="erreur"> ces informations ne sont pas valide ! </p>';
                    }
                }

                ?>
                <div class="mb-3 position-relative">
                    <div class="input-group">
                        <input type="password" class="form-control" name="nouvMdp" id="nouvMdp" placeholder="Nouveau Mot de passe" value="">
                        <button class="btn btn-outline-secondary bi bi-eye" type="button" id="togglePassword"></button>
                    </div>
                </div>

                <div class="mb-3 position-relative">
                    <div class="input-group">
                        <input type="password" class="form-control" name="mdpConfirm" id="mdpConfirm" placeholder="Confirmer Le Nouveau Mot de passe" value="">
                        <button class="btn btn-outline-secondary bi bi-eye" type="button" id="togglePassword"></button>
                    </div>
                </div>

                <div class="d-grid">
                    <input type="hidden" name="idUser" value="<?php echo isset($_GET['idUser']) ? $_GET['idUser'] : ''; ?>">
                    <input type="submit" class="btn-payer mx-auto" value="Envoyer" name="btnsubmitmdpOublie1">
                </div>
            </form>
        </div>
    </div>
</div>