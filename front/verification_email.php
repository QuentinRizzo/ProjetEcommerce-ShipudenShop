<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 feuille-contact w-100 mt-5 mb-5" id="mdpToogle">
      <h3 class="text-center mb-5 mt-5">Mot de passe oublier</h3>
      <form class="mb-5" method="post" action="../controler/traitement_mdp_oublier.php" id="form2-mdp">
        <?php
        if (isset($_GET['sucess'])) {

          if ($_GET['sucess'] == 'mailEnvoyer') {
            echo '<p class="success">Un mail vous as été envoyer ! </p>';
          }
        }
        if (isset($_GET['error'])) {

          if ($_GET['erreur'] == 'identifiants') {
            echo '<p class="erreur">Vos informations de connexions sont incorrect ! </p>';
          }
        }
        ?>
        <div class="col-md-12 form-group mb-5">
          <input type="text" class="form-control" name="mail" id="mail" placeholder="Adresse Mail du compte">
        </div>

        <div class="d-grid">
          <input type="submit" class="btn-payer mx-auto" value="Envoyer" name="btnsubmitmdpOublie1">
        </div>
      </form>
    </div>
  </div>
</div>