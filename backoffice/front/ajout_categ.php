<div class="container-fluid">

    <div class="form h-100 feuille-contact mt-5 p-4">
        <h1 class="text-center mb-5 mt-5">Ajouter une Categorie</h1>
        <form class="mb-5" method="post" action="../controler/traitement_ajout_categ.php" enctype="multipart/form-data">
            <?php
            if (isset($_GET['success'])) {

                if ($_GET['success'] == 'InsertCategSuccess') {
                    echo '<p class="text-center text-success">La catégorie a été ajouter avec Succès ! </p>';
                }
            }
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 'CategExiste') {
                    echo '<p class="Error text-center text-danger">Cette catégorie existe déja  ! </p>';
                }
            }

            ?>
            <div class="row">
                <div class="col-md-12 form-group mb-3">
                    <label for="nomCateg" class="col-form-label">Nom :</label>
                    <input type="text" class="form-control" name="nomCateg" id="nomCateg" placeholder="nom de la categorie">
                </div>
                
            <div class="row mt-2">
                <div class="col-md-12 form-group mb-3 d-flex align-items-center justify-content-center">
                        <input type="submit" value="Ajouter" class="btn-card text-center w-25" name="ajout-figurine">
                        <span class="submitting"></span>
                </div>
            </div>
        </form>
    </div>
</div>