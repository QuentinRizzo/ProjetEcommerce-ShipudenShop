<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$recupCateg =  recupCategories($pdo);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center justify-content-between mt-5">
            <h1>Affichage Utilisateurs</h1>
            <button class="btn-card  text-center"><a class="nav-link text-light" href="../public/index.php?page=14">Ajouter Categorie</a></button>
        </div>
    </div>
</div>
<section class="intro mt-5 mb-5">
    <div class="container-fluid">
        <?php
        if (isset($_GET['sucess'])) {

            if ($_GET['sucess'] == 'suprimerAvecSuccess') {
                echo '<p class="text-success text-center">L utilisateur à été supprimé avec succès ! </p>';
            }
            if ($_GET['sucess'] == 'UtilisateurMaj') {
                echo '<p class="Error text-center text-success">Utilisateur mis a jour avec succès! </p>';
            }
        }
        if (isset($_GET['erreur'])) {

            if ($_GET['erreur'] == 'erreurSupression') {
                echo '<p class="Error text-center text-danger">Une erreur est survenue lors de la suppression !</p>';
            }
            if ($_GET['erreur'] == 'ErreurMajUtilisateur') {
                echo '<p class="Error text-center text-danger">Une erreur est survenu lors de la modification ! </p>';
            }
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom de la catégorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($recupCateg as $indice => $categ) {
                                        $indice++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $indice; ?></th>
                                            <td><?php echo $categ['nom_categorie'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>