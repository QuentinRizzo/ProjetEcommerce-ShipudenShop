<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";

$produitExiste = recupListeProduits($pdo);

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center justify-content-between mt-5">
            <h1>Affichage des produits</h1>
            <button class="btn-card  text-center"><a class="nav-link text-light" href="../public/index.php?page=5">Ajouter un article</a></button>
        </div>
    </div>
</div>
<section class="intro mt-5 mb-5">
    <!-- <form method="post" action="../controler/traitement_produits.php"> -->
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
                                            <th scope="col">Nom</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($produitExiste as $indice=>$produit) {
                                            $indice++;
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $indice; ?></th>
                                                <td><?php echo $produit['titre'] ?></td>
                                                <td><img class="img-fluid img-prod-BackOffice" src="../../public/ressource/figurines/<?php echo $produit['logo'] ?>" alt="<?php echo $produit['logo'] ?>"></td>
                                                <td><?php echo $produit['stock'] ?></td>
                                                <td class="d-flex align-items-center">

                                                    <form action="../controler/traitement_delete_produits.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                                        <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit']; ?>">
                                                        <input type="hidden" name="action" value="suprimerProduit">
                                                        <button type="submit" class="btn btn-danger btn-sm me-1" data-mdb-toggle="tooltip" title="Retirer l'article">
                                                            <i class="bi bi-trash-fill fs-4"></i>
                                                        </button>
                                                    </form>


                                                    <form action="../public/index.php?page=6" method="post">
                                                        <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit']; ?>">
                                                        <input type="hidden" name="action" value="Editerproduit">
                                                        <button type="submit" class="btn btn-secondary btn-sm me-1" title="Editer le produit">
                                                            <i class="bi bi-pencil-square fs-4"></i>
                                                        </button>
                                                    </form>

                                                    <form action="../public/index.php?page=7" method="post">
                                                        <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit']; ?>">
                                                        <input type="hidden" name="action" value="Afficherproduit">
                                                        <button type="submit" class="btn btn-primary btn-sm" title="Afficher l'article">
                                                            <i class="bi bi-eye fs-4"></i>
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