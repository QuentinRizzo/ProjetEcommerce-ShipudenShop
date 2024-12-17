<?php 
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

$reductionExiste = listeBonreductionExistanteBdd($pdo);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center justify-content-between mt-5">
            <h1>Affichage des Réduction</h1>
            <button class="btn-card  text-center"><a class="nav-link text-light" href="../public/index.php?page=12">Ajouter une Réduction</a></button>
        </div>
    </div>
</div>
<section class="intro mt-5 mb-5">
        <div class="container-fluid">
            <?php
            if (isset($_GET['sucess'])) {

                if ($_GET['sucess'] == 'ok') {
                    echo '<p class="text-success text-center">Le produit à été ajouter avec succès ! </p>';
                }
                if ($_GET['sucess'] == 'produitMAj') {
                    echo '<p class="text-success text-center">Le stock du produit à été Mis a jour avec succès ! </p>';
                }
            }
            if (isset($_GET['erreur'])) {

                if ($_GET['erreur'] == 'FigurineExiste') {
                    echo '<p class="Error text-center text-danger">Le produit existe déja ! </p>';
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
                                            <th scope="col">Article min</th>
                                            <th scope="col">Taux</th>
                                            <th scope="col">Début</th>
                                            <th scope="col">Fin</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($reductionExiste as $indice=>$reduction) {
                                            $indice++;
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $indice; ?></th>
                                                <td><?php echo $reduction['nb_articles_min'] ?></td>
                                                <td><?php echo $reduction['taux'] ?></td>
                                                <td><?php echo $reduction['date_debut'] ?></td>
                                                <td><?php echo $reduction['date_fin'] ?></td>
                                                <td class="d-flex align-items-center">

                                                    <form action="../controler/traitement_delete_bonreduction.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette Réduction ?');">
                                                        <input type="hidden" name="id_bon" value="<?php echo $reduction['id_bon']; ?>">
                                                        <input type="hidden" name="action" value="suprimerBon">
                                                        <button type="submit" class="btn btn-danger btn-sm me-1" data-mdb-toggle="tooltip" title="Retirer Reduction">
                                                            <i class="bi bi-trash-fill fs-4"></i>
                                                        </button>
                                                    </form>


                                                    <form action="../public/index.php?page=13" method="post">
                                                        <input type="hidden" name="id_bon" value="<?php echo $reduction['id_bon']; ?>">
                                                        <input type="hidden" name="action" value="EditerBonReduc">
                                                        <button type="submit" class="btn btn-secondary btn-sm me-1" title="Editer la Reduction">
                                                            <i class="bi bi-pencil-square fs-4"></i>
                                                        </button>
                                                    </form>
                                                </td>
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