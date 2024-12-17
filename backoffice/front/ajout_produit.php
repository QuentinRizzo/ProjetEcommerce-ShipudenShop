<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$recupCateg = recupCateg($pdo);
?>
<div class="container-fluid">

    <div class="form h-100 feuille-contact mt-5 p-4">
        <h1 class="text-center mb-5 mt-5">Ajouter un Article</h1>
        <form class="mb-5" method="post" action="../controler/traitement_ajout_produits.php" enctype="multipart/form-data">
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
            }

            ?>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="titre-figurine" class="col-form-label">Titre :</label>
                    <input type="text" class="form-control" name="titre-figurine" id="titre-figurine" placeholder="Titre de la figurine">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="materiel-figurine" class="col-form-label">materiel :</label>
                    <input type="text" class="form-control" name="materiel-figurine" id="materiel-figurine" placeholder="materiel de la figurine">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="taille-figurine" class="col-form-label">Taille :</label>
                    <input type="text" class="form-control" name="taille-figurine" id="taille-figurine" placeholder="taille de la figurine">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="prix-unite-figurine" class="col-form-label">Prix Unité</label>
                    <input type="text" class="form-control" name="prix-unite-figurine" id="prix-unite-figurine" placeholder="Prix Unité">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" name="desc-figurine" id="exampleFormControlTextarea1" rows="3" placeholder="Description de l'article"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Choix de la categorie :</label>
                    
                    <select name="categ-figurine" class="form-select" aria-label="Default select example">
                        <option selected>Choisir la catégorie</option>
                        <?php foreach($recupCateg as $categ){ ?>
                        <option value="1"><?php echo $categ['nom_categorie']?></option>
                        <?php } ?>
                    </select>
                    
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="Inp-ajt-figurine" class="col-form-label">Ajouter Image :</label>
                    <input aria-colspan="Inp-ajt-figurine" type="file" class="form-control" name="logo" id="inputFile">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 form-group mb-3 d-flex align-items-center justify-content-center">
                    <form action="../controler/traitement_ajout_produits.php" method="post" class="col-md-12 form-group text-center mt-5">
                        <input type="submit" value="Ajouter" class="btn-card text-center w-25" name="ajout-figurine">
                        <span class="submitting"></span>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>