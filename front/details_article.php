<?php
require "../model/connexion_bdd.php";
// require "../model/fonctions.php";
$id_produit = $_POST['idProd'];
$recupProduit = recupDetailProduit($pdo, $id_produit);
?>

<div class="row mx-auto mt-1 d-flex mx-auto">
  <div class="col-lg-5 mx-auto">

    <img src="../public/ressource/figurines/<?php echo $recupProduit['logo'] ?>" class="d-block w-80 mt-5 mb-3 img-fluid image-card-equipe image-detailArticle" alt="<?php echo $recupProduit['titre'] ?>">
  </div>
  <div class="row mx-auto mt-1 box-descProd-bOffice">
    <div class="col-lg-12 text-center h-100 box-ficheProd-Deskop">
      <div class="box-detailtext mt-5 mb-5 mx-auto w-100">
        <div class="row">
          <h1 class="mt-5 text-light fs-1">Fiche Du Produit</h1>
          <div class="col-lg-6">
            <h5 class="card-title text-center text-light mt-5">Nom :</h5>
            <p class="card-text text-center text-light"><?php echo $recupProduit['titre'] ?></p>
          </div>
          <div class="col-lg-6">
            <h5 class="card-title text-center text-light mt-5">Materiel :</h5>
            <p class="card-text text-center text-light"><?php echo $recupProduit['materiel'] ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <h5 class="card-title text-center text-light mt-5">Prix Unité:</h5>
            <p class="card-text text-center text-light"><?php echo $recupProduit['prix_unit'] ?></p>
          </div>
          <div class="col-lg-6">
            <h5 class="card-title text-center text-light mt-5">Stock :</h5>
            <p class="card-text text-center text-light"><?php echo $recupProduit['stock'] ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <h5 class="card-title text-center text-light mt-3">Description :</h5>
            <p class="card-text text-center text-light"><?php echo $recupProduit['description'] ?></p>
          </div>
        </div>
        <a href="../public/index.php?page=2" class="btn-desc btn mt-5 mb-5 mx-auto">Retour à la gestion</a>
      </div>
    </div>
  </div>
</div>