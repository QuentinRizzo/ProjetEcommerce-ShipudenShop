<?php
$user = recupInfosUsers($pdo, $_SESSION['idUser']);
?>

<div class="col py-3">
    <div class="container mt-5">

        <div class="form h-100 feuille-contact">

            <h3 class="text-center mb-5 mt-5">Mes informations personnelles</h3>


            <form class="mb-5" method="post" id="contactForm" name="contactForm">

                <div class="row">
                    <div class="col-md-6 form-group mb-5">
                        <label for="name" class="col-form-label">Nom :</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom" value="<?php echo htmlspecialchars($user['nom'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="col-md-6 form-group mb-5">
                        <label for="prenom" class="col-form-label">Prénom :</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php echo htmlspecialchars($user['prenom'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-5">
                        <label for="mail" class="col-form-label">Email :</label>
                        <input type="text" class="form-control" name="mail" id="mail" placeholder="Votre Adresse Mail" value="<?php echo htmlspecialchars($user['mail'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="col-md-6 form-group mb-5">
                        <label for="tel" class="col-form-label">Tel:</label>
                        <input type="text" class="form-control" name="tel" id="tel" placeholder="Votre Numéro de téléphone" value="<?php echo htmlspecialchars($user['tel'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-5">
                        <label for="ville" class="col-form-label">Ville :</label>
                        <input type="text" class="form-control" name="ville" id="ville" placeholder="Votre Ville" value="<?php echo htmlspecialchars($user['nom_ville'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="col-md-6 form-group mb-5">
                        <label for="adresse" class="col-form-label">Adresse :</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Votre Adresse" value="<?php echo htmlspecialchars($user['adresse'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 me-5 form-group d-flex justify-content-end">
                        <input type="submit" value="Enregistrer" class="btn-payer mx-auto">
                        <span class="submitting"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 me-5 mt-5 form-group d-flex justify-content-end">
                        <a href="../public/index.php?page=8" class="nav-link mx-auto text-light">Mes factures</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 me-5 mt-5 form-group d-flex justify-content-end">
                        <a href="#" class="nav-link mx-auto text-light" id="modifierMdp">Modifier mon mot de passe</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container" id="form-mdp" style="display: none;">
    <div class="row justify-content-center">

        <div class="col-md-6 feuille-contact w-100" id="mdpToogle">
            <h3 class="text-center mb-5 mt-5">Modification du Mot de passe</h3>
            <form class="mb-5" method="post" action="../controler/traitement_modifier_mdp.php">
                <div class="col-md-12 form-group mb-3">
                <label for="modifPasswordActuel" class="col-form-label">Mot de passe Actuel :</label>
                    <div class="input-group mdpforjs">
                        <input class="afficher form-control" type="password" name="mdpInscription" id="modifPasswordActuel" placeholder="Mot de passe" autocomplete="new-password">
                        <button class="btn btn-outline-secondary bi bi-eye" type="button" id="modifActuelMdp"></button>
                    </div>
                </div>
                <h3 class="text-center mb-5 mt-5">Nouveau Mot de passe</h3>
                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <label for="ChangeMdp" class="col-form-label">Mot de passe :</label>
                    <div class="input-group mdpforjs">
                      <input class="afficher form-control" type="password" name="mdpInscriptionNouv" id="modifNouvPassword" placeholder="Mot de passe" autocomplete="new-password">
                      <button class="btn btn-outline-secondary bi bi-eye affichage" type="button" id="changeMdp"></button>
                    </div>
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label for="confirmChangeMdp" class="col-form-label">Confirmer le mot de passe :</label>
                    <div class="input-group mdpforjs">
                      <input class="afficher form-control" type="password" name="mdpInscriptionConfirm" id="modifConfirmNouvPassword" placeholder="Confirmer le mot de passe" autocomplete="new-password">
                      <button class="btn btn-outline-secondary bi bi-eye affichage" type="button" id="confirmChangeMdp"></button>
                    </div>
                  </div>
                </div>
                
                <div class="d-grid mt-5">
                    <input type="submit" class="btn-payer mx-auto" value="Valider" name="btn">
                </div>
            </form>
        </div>
    </div>
</div>