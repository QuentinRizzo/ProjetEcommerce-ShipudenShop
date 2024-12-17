<?php
require "../model/fonctions.php";
require "../model/connexion_bdd.php";

$departements = recupDepartement($pdo);
?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../public/index.php">
      <h1 class="logo m-4">Shippuden Shop</h1>
    </a>
    <!-- Bouton du menu hamburger -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Lien de la NavBar -->
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link mt-5 text-light" href="../public/index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mt-5 text-light" href="../public/index.php?page=1">Figurines</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mt-5 text-light" href="../public/index.php?page=3">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item responsive-iconNav">
          <div class="d-flex align-items-center text-light">
            <?php
            // Liens que les utilisateur connecter verrons \\
            if (isset($_SESSION['idUser'])) {
            ?>
              <a class="text-decoration-none text-center nav-link text-light" href="../public/index.php?page=11"><i class="nav-link text-light  bi-heart fs-3 mx-3"></i>Favoris</a>
              <a class="text-decoration-none text-center nav-link text-light" href="../public/index.php?page=6"><i class="nav-link text-light  bi-cart fs-3 mx-3"></i>Pannier</a>
              <!-- <a href="../public/index.php?page=7"><i class="nav-link text-light fs-2 mx-3 bi bi-person-lines-fill"></i></a> -->
              <a href="#" class="mx-5  d-flex  align-items-center justify-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../public/ressource/img/logo.png" alt="hugenerd" width="80" height="80" class="rounded-circle">
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small  shadow text-center dropdown-modif">
                <li><a class="dropdown-item" href="../public/index.php?page=7">Mon Profile</a></li>
                <?php
                if ($_SESSION['idRoleUser'] == 4 || $_SESSION['idRoleUser'] == 5) {
                ?>
                  <li><a class="dropdown-item" target="_blank" href="../backoffice/public/index.php?page=1">Administration</a></li>
                <?php
                }
                ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../controler/traitement_deconnexion.php">Deconnexion</a></li>
              </ul>
        <li class="nav-item responsive-iconNav">
        </li>
      <?php
            } else {
      ?>
        <a class="text-decoration-none text-center nav-link text-light" href="../public/index.php?page=6"><i class="nav-link text-light  bi-cart fs-3 mx-3"></i>Panier</a>
        <button type="button" class="nav-link text-light iconCoResponsive " data-bs-toggle="modal" data-bs-target="#ModalConnexion"><i class="nav-link text-light  bi-person fs-3 mx-3"></i>Connexion</button>
        <button type="button" class="nav-link text-light " data-bs-toggle="modal" data-bs-target="#ModalInscription"><i class="nav-link text-light  bi-person-plus fs-3 mx-3"></i>Inscription</button>
      <?php } ?>
    </div>
    </li>
    </ul>
    </div>
  </nav>
</header>


<!-- Modal connexion -->
<div class="modal fade" id="ModalConnexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-modal">
      <div class="modal-body">
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-md-6 feuille-contact w-100">
              
            <div class="col-lg-12">
              <i class="bi bi-x-octagon fs-2 mt-1 btnModalCo" id="btnModalCo"></i>
              </div>

              <h3 class="text-center mb-5 mt-5">Connexion</h3>
              <form class="mb-5" method="post" action="../controler/traitement_connexion.php">

                <!-- Début Connexion PhP -->
                <?php
                if (isset($_GET['sucess'])) {

                  if ($_GET['sucess'] == 'connexionSuccess') {
                    echo '<p class="success">Vous êtes maintenant connecter ! </p>';
                  }
                  if ($_GET['sucess'] == 'MdpModifier') {
                    echo '<p class="success">Vôtre mot de passe a bien été modifier ! </p>';
                  }
                  if ($_GET['sucess'] == 'emailEnvoyer') {
                    echo '<p class="success">un mail vous as été envoyer avec succès </p>';
                  }
                }


                if (isset($_GET['erreur'])) {

                  if ($_GET['erreur'] == 'identifiants') {
                    echo '<p class="erreur">Vos informations de connexions sont incorrect ! </p>';
                  }
                  if ($_GET['erreur'] == 'PasIdentique') {
                    echo '<p class="erreur">Vos informations saisie sont incorrect ! </p>';
                  }
                  if ($_GET['erreur'] == 'emailpastrouve') {
                    echo '<p class="erreur">un mail vous as été envoyer ! </p>';
                  }
                }

                ?>
                <div class="mb-3 position-relative">
                  <input type="email" class="form-control" name="mail" id="mail" placeholder="Email">
                </div>
                <div class="mb-3 position-relative">
                  <div class="input-group mdpforjs">
                    <input class="afficher form-control" type="password" name="mdpConnexion" id="coPassword" placeholder="Mot de passe" autocomplete="current-password">
                    <button class="btn btn-outline-secondary bi bi-eye affichage" type="button" id="co"></button>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberPassword">
                    <label class="form-check-label" for="rememberPassword">Enregistrer le mot de passe</label>
                  </div>
                </div>
                <div class="mb-3 d-flex align-item-center justify-content-between">
                  <button type="button" class="nav-link text-light " data-bs-toggle="modal" data-bs-target="#ModalInscription">Pas encore de compte ?</button>
                  <a href="../public/index.php?page=9" class="float-end text-decoration-none">Mot de passe oublié ?</a>
                </div>
                
                <div class="d-grid">
                  <input type="submit" class="btn-payer mx-auto" value="Se connecter" name="btn">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ==================================================================================== -->

<!-- Modal Inscription-->
<div class="modal fade" id="ModalInscription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-modal">
      <div class="modal-body">
        <div class="container mt-5">
          <div class="row mx-auto">
            <div class="form h-100 feuille-contact">
            <div class="col-lg-12">
              <i class="bi bi-x-octagon fs-2 mt-1 btnModalCo" id="btnModalInscription"></i>
              </div>
              <h3 class="text-center mb-5 mt-5">Inscription</h3>
              <form class="mb-5" method="post" action="../controler/traitement_inscription.php">

                <!-- Début Inscription PhP -->
                <?php
                if (isset($_GET['erreur'])) {

                  if ($_GET['erreur'] == 'emailExiste') {
                    echo '<p class="Error">Cette email existe déja </p>';
                  }
                  if ($_GET['erreur'] == 'mdpConfirm') {
                    echo '<p class="Error">Les deux mot de passe ne conrespondent pas </p>';
                  }
                }
                ?>

                <!-- Fin Inscription Connexion PhP -->

                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <label for="nom" class="col-form-label">Nom :</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom">
                  </div>
                  <div class="col-md-6 form-group mb-3">
                    <label for="prenom" class="col-form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <label for="email" class="col-form-label">Email :</label>
                    <input type="email" class="form-control" name="mail" id="email" placeholder="Votre Email" autocomplete="off">
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label for="email" class="col-form-label">Email :</label>
                    <input type="email" class="form-control" name="mailConfirm" id="emailConfirm" placeholder="Confirmer Votre Email" autocomplete="off">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <label for="coInscriptionPassword" class="col-form-label">Mot de passe :</label>
                    <div class="input-group mdpforjs">
                      <input class="afficher form-control" type="password" name="mdpInscription" id="coInscriptionPassword" placeholder="Mot de passe" autocomplete="new-password">
                      <button class="btn btn-outline-secondary bi bi-eye affichage" type="button" id="coInscription"></button>
                    </div>
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <label for="coInscriptionConfirmPassword" class="col-form-label">Confirmer le mot de passe :</label>
                    <div class="input-group mdpforjs">
                      <input class="afficher form-control" type="password" name="mdpInscriptionConfirm" id="coInscriptionConfirmPassword" placeholder="Confirmer le mot de passe" autocomplete="new-password">
                      <button class="btn btn-outline-secondary bi bi-eye affichage" type="button" id="coInscriptionConfirm"></button>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <select name="departement" id="departement" class="form-select" aria-label="Default select example">
                      <option value="">choix du département</option>
                      <?php foreach ($departements as $dept) { ?>
                        <option value="<?php echo htmlspecialchars($dept['id_departement'], ENT_QUOTES, 'UTF-8') ?>"><?php echo htmlspecialchars($dept['nom_departement'], ENT_QUOTES, 'UTF-8') ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-md-6 form-group mb-3">
                    <select class="form-select" name="ville" id="ville">
                      <option value="">Choix de vôtre ville</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group mb-3">
                    <label for="adresse" class="col-form-label">Adresse :</label>
                    <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Votre adresse">
                  </div>
                  <div class="col-md-6 form-group mb-3">
                    <label for="telephone" class="col-form-label">Numéro de téléphone :</label>
                    <input type="tel" class="form-control" name="tel" id="telephone" placeholder="Numéro de téléphone" autocomplete="off">
                  </div>
                </div>

                <div class="row">
                  <form action="../controler/traitement_inscription.php" method="post" class="col-md-12 form-group text-center mt-5">
                    <input type="submit" value="S'inscrire" class="btn-card">
                    <span class="submitting"></span>
                  </form>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--  -->