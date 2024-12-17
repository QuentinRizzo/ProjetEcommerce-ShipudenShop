<div class="container-fluid">
    <div class="form h-100 feuille-contact mt-5 p-4">
        <?php
        if (isset($_GET['success'])) {

            if ($_GET['success'] == 'reductionAppliquer') {
                echo '<p class="Error text-center text-success">La réduction à été appliquer avec succès !</p>';
            }
        }
        if (isset($_GET['erreur'])) {

            if ($_GET['erreur'] == 'reductionExistante') {
                echo '<p class="Error text-center text-danger">Une réduction est déja en cours ! </p>';
            }
        }

        ?>
        <h1 class="text-center mb-5 mt-5">Ajouter une Reduction</h1>
        <form class="mb-5" method="post" action="../controler/traitement_ajout_reduction.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="date-debut" class="col-form-label">Date de Début :</label>
                    <input type="date" class="form-control" name="date_debut" id="date-debut">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="date-fin" class="col-form-label">Date de Fin :</label>
                    <input type="date" class="form-control" name="date_fin" id="date-fin">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="nbArticle" class="col-form-label">Nombre D'article :</label>
                    <input type="number" class="form-control" name="nbArticle" min="0" id="nbArticle" value="0">
                </div>
                <div class="col-md-6 form-group mb-3">
                <label for="tauxReduction" class="col-form-label">Taux de Réduction :</label>
                <input type="text" class="form-control" name="tauxReduction" value="0">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 form-group mb-3 d-flex align-items-center justify-content-center">
                    <form action="../controler/traitement_ajout_reduction.php" method="post" class="col-md-12 form-group text-center mt-5">
                        <input type="submit" value="Ajouter" class="btn-card text-center w-25" name="ajout-figurine">
                        <span class="submitting"></span>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>