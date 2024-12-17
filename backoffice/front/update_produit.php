<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$recupCateg = recupCateg($pdo);
$id_produit = $_POST['id_produit'];
$recupProduit = recupProduits($pdo, $id_produit);

?>

<div class="container-fluid">

    <div class="form h-100 feuille-contact mt-5 p-4">
        <h1 class="text-center mb-5 mt-5">Modifier L'Article</h1>
        <form class="mb-5" method="post" action="../controler/traitement_update_produit.php" enctype="multipart/form-data">

            <!-- Début Inscription PhP -->
            <?php

            if (isset($_GET['erreur'])) {

                if ($_GET['erreur'] == 'FigurineExiste') {
                    echo '<p class="Error text-center text-danger">Le produit existe déja ! </p>';
                }
                if ($_GET['erreur'] == 'erreurUpload') {
                    echo '<p class="Error text-center text-danger">Une erreur est survenu ! </p>';
                }

                if ($_GET['erreur'] == 'fichierInvalide') {
                    echo '<p class="Error text-center text-danger">Le fichier est Invalide ! </p>';
                }

                if ($_GET['erreur'] == 'aucunFichier') {
                    echo '<p class="Error text-center text-danger ">Aucun Fichier na était séléctionner ! </p>';
                }
                if ($_GET['erreur'] == 'erreurMaj') {
                    echo '<p class="Error text-center text-danger ">Une erreur est survenue lors de la Mise a jour du produit ! </p>';
                }
            }

            ?>

            <!-- Fin Inscription Connexion PhP -->

            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="titreEdit" class="col-form-label">Titre :</label>
                    <input type="text" class="form-control" name="titreEdit" id="titreEdit" value="<?php echo $recupProduit['titre'] ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="materielEdit" class="col-form-label">materiel :</label>
                    <input type="text" class="form-control" name="materielEdit" id="materielEdit" value="<?php echo $recupProduit['materiel'] ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="tailleEdit" class="col-form-label">Taille :</label>
                    <input type="text" class="form-control" name="tailleEdit" id="tailleEdit" value="<?php echo $recupProduit['taille'] ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="prix_unitEdit" class="col-form-label">Prix Unité :</label>
                    <input type="text" class="form-control" name="prix_unitEdit" id="prix_unitEdit" value="<?php echo $recupProduit['prix_unit'] ?>">
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="stockEdit" class="col-form-label">Quantité :</label>
                    <input type="text" class="form-control" name="stockEdit" id="stockEdit" value="<?php echo $recupProduit['stock'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="descEdit" id="exampleFormControlTextarea1" rows="3"><?php echo $recupProduit['description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Choix de la categorie :</label>
                    
                    <select name="categEdit" class="form-select" aria-label="Default select example">
                        <option selected>Choisir la catégorie</option>
                        <?php foreach($recupCateg as $categ){ ?>
                        <option value="1"><?php echo $categ['nom_categorie']?></option>
                        <?php } ?>
                    </select>
                    
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="Inp-ajtEdit" class="col-form-label">Ajouter Image :</label>
                    <input aria-colspan="Inp-ajtEdit" type="file" class="form-control" name="logo" id="inputFile">
                    <p>Nom de l'image Actuel : <?php echo $recupProduit['logo'].' '.$recupProduit['titre'] ?></p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 form-group mb-3 d-flex align-items-center justify-content-center">
                <form action="../controler/traitement_uptdate_produits.php" method="post" class="col-md-12 form-group text-center mt-5">
                        <input type="hidden" name="id_produit" value="<?php echo $recupProduit['id_produit'] ?>">
                        <input type="submit" value="Enregistrer" class="btn-card text-center w-25" name="ajoutEdit">
                        <span class="submitting"></span>
                    </form>
                </div>
            </div>
        </form>
    </div>

</div>