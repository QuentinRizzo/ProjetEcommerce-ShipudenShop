<?php
$produits = listeDesProduitsLesPlusVendu($pdo);
$recupAvisClient = listeAvisClient($pdo);
?>
<div class="col bg-header carousel">
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../public/ressource/img/onepiece.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../public/ressource/img/bannermanga.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../public/ressource/img/test.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Retour</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Suivant</span>
    </button>
  </div>
</div>
<?php
if (isset($_GET['sucess'])) {

  if ($_GET['sucess'] == 'AvisPublier') {
    echo '<p class="text-center text-success fs-3 mt-2">Votre Avis a été publier avec succès ! </p>';
  }
}

if (isset($_GET['error'])) {

  if ($_GET['error'] == 'userDeconnecter') {
    echo '<h2 class="text-center text-danger fs-3 mt-2">Vous devez être connecter pour payer vos articles ! </h2>';
  }

  if ($_GET['erreur'] == 'AvisExistant') {
    echo '<p class="text-center text-danger fs-3 mt-2">Vous avez déja poster un Avis </p>';
  }
  if ($_GET['erreur'] == 'AvisNonPublier') {
    echo '<p class="text-center text-danger fs-3 mt-2">Une erreur c`est produit veuillez réessayez ! </p>';
  }
}
?>
<div class="row w-50 mx-auto mt-5 box-bienvenue">
  <div class="card-body text-center mx-auto mb-3 bg-dark ">
    <div class="card bg-dark border-card">
      <h2 class="logo-header text-center text-light fs-1 mb-3 mt-2">Bienvenue sur Shippuden Shop</h2>
      <h3 class="card-header-text fs-4 mb-4 mt-4"> Figurine Mangas - Le Japon à portée de Main ! </h3>
      <p class="card-header-text fs-6 mb-4 mt-4"> Au Japon, la culture à travers les Figurines Manga que nous vous
        présentons
        sur notre Boutique ! </p>
    </div>
  </div>
</div>

<div class="box-presentation row w-100 mt-5">
  <div class="col">
    <h2 class="Title-h2 fs-1 text-dark">Nos Meilleurs Ventes</h2>
    <p class="p-desc fs-4 text-dark">Retrouver nos articles qui ont été le plus vendu !</p>
  </div>
</div>

<!-- Section 1 -->
<div class="bg-card-section1 mt-5 mb-5">
  <div class="container">
    <!-- ligne Card 1 -->
    <div class="row mx-auto" id="AffichageProdFiltrees">
      <!-- // ici On parcours le foreach pour récupérer les articles plus haut -->
      <?php foreach ($produits as $produit) { ?>
        <div class="col-lg-4 col-sm-6 mx-auto mt-5 mb-5">
          <div class="card">
            <?php if (isset($_SESSION['idUser'])) { ?>
              <form action="../controler/traitement_ajout_favoris.php" method="post">
                <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>">
                <button type="submit" class="nav-link ajout-favoris text-light d-flex">
                  <i class="icon-card bi bi-heart fs-3 mx-5 ml-auto"></i>
                </button>
              </form>
            <?php } else { ?>
              <button type="submit" id="ajoutfav" class="nav-link ajout-favoris text-light d-flex">
                <i class="icon-card bi bi-heart fs-3 mx-5 ml-auto"></i>
              </button>
            <?php } ?>
            <div class="card-img-top">

              <img src="../public/ressource/figurines/<?php echo $produit['logo'] ?>" class="img-card img-fluid mx-auto d-block" alt="<?php echo $produit['logo'] ?>">
              <div class="line"></div>
            </div>
            <div class="card-block d-flex flex-column bg-white text-dark">
              <h3 class="text-center mt-2 fs-2"><?php echo $produit['titre'] ?></h3>
              <p class="text-center mt-2">Materiel : <?php echo $produit['materiel'] ?></p>
              <p class="text-center mt-2">Taille : <?php echo $produit['taille'] ?> cm</p>
              <p class="text-center mt-2"><span class="span">Prix : <?php echo $produit['prix_unit'] ?> €</span></p>
            </div>
          </div>
          <a href="../public/index.php?page=4"><input type="submit" value="Afficher L'article" class="btn-card w-100 mt-2"></a>
          <a href="../public/index.php?page=1"><input type="submit" value="Voir tout nos Articles" class="btn-card w-100 mt-2"></a>
        </div>
      <?php } ?>
      <!-- // fin foreach -->
    </div>
  </div>
</div>

<!-- Section Avis Client -->
<div class="box-avis-clients">
  <div class="row w-50 mx-auto mt-5 card-box-title-index">
    <div class="col-lg-12 text-center mx-auto box-lac ">
      <div class="h-100 py-5 mx-auto bg-dark rounded-3 border-card">
        <h3 class="logo-header text-center text-light fs-1 mb-3 mt-2">Nos Derniers Avis</h3>
        <p class=" text-light fs-5 mb-1 mt-2">De Nombreuse personnes nous ont fait confiance et ont souhaitez
          partager leurs ressentit avec Vous!. N'hésitez pas a vous laisser tenter par nos Figurines de qualités !
        </p>
      </div>
    </div>
  </div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-5">
    <div class="col">
      <div class="card mb-3 border-card" style="max-width:540px;">
        <div class="row g-0">
          <?php foreach ($recupAvisClient as $avisClient) { ?>
            <div class="col-md-6 text-center mt-3">
              <h2><?php echo $avisClient['nom'] . ' ' . $avisClient['prenom'] ?></h2>
              <h5>Date de la publication :</h5>
              <p><?php echo $avisClient['date'] ?></p>
            </div>
            <div class="col-md-6">
              <div class="card-body cardAvisResponsive">
                <h4 class="card-title text-light"><?php echo $avisClient['titre_avis'] ?></h4>
                <p class="card-text text-light"><?php echo $avisClient['desc_avis'] ?></p>
                <p class="card-text">
                  <small class="text-muted">
                    <?php for ($i = 1; $i < 6; $i++) { ?>
                      <i class="stars-avis bi bi-star-fill <?php if ($i <= $avisClient['notes']) { ?>hover<?php } ?>"></i>
                    <?php } ?>
                    <i class="note text-light text-center"> / 5</i>
                  </small>
                </p>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="col-lg-12 d-flex align-items-center justify-content-center w-100 h-2">
      <button type="button" class="btn-card w-100 p-2 mt-2 text-center " data-bs-toggle="modal" data-bs-target="#avisClient">Notez-Nous</button>
    </div>

  </div>
</div>

<!-- modal avis clients -->
<div class="modal fade " id="avisClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content bg-modal">
      <div class="modal-body">
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-md-6 feuille-contact w-100">
              <form action="../controler/traitement_avis.php" method="post" class="col-md-12 form-group text-center mt-2">
                <h3 class="text-center mb-5 mt-5">Ajouter votre avis</h3>
                <!-- Fin Avis Client -->
                <div class="mb-3 position-relative">
                  <input type="text" class="form-control" name="titreAvis" id="titreAvis" placeholder="Votre titre">
                </div>
                <label class="text-light" for="note">Votre Note :</label>
                <div class="mb-3 position-relative">

                  <input type="hidden" name="noteClient" class="text-muted col-lg-12 d-flex" id="noteclient">
                  <i class="stars-avis bi bi-star-fill mx-1 star" data-note="1"></i>
                  <i class="stars-avis bi bi-star-fill mx-1 star" data-note="2"></i>
                  <i class="stars-avis bi bi-star-fill mx-1 star" data-note="3"></i>
                  <i class="stars-avis bi bi-star-fill mx-1 star" data-note="4"></i>
                  <i class="stars-avis bi bi-star-fill mx-1 star" data-note="5"></i>
                  <p class=" text-light note"></p>
                  </input>

                </div>
                <div class="mb-3 position-relative">
                  <textarea class="w-100" name="descAvis" id="descAvis" cols="30" rows="10" placeholder="Votre Message..."></textarea>
                </div>

                <input type="submit" value="Voter" class="btn-card w-25 p-2 h-2 mb-3">
                <span class="submitting "></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>