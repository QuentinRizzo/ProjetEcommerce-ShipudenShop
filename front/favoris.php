<?php
if (isset($_SESSION['idUser'])) {
    $id_user = $_SESSION['idUser'];
    $produits = recupFavorisUser($pdo, $id_user);
?>
    <?php
    if (isset($_GET['sucess'])) {

        if ($_GET['sucess'] == 'SupprimerFavoris') {
            echo '<h2 class="text-center text-success">Le produit a été supprimer des Favoris Avec succès ! </h2>';
        }
    }
    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'ErreurSupressionFavoris') {
            echo '<h2 class="text-center text-danger">Une erreur c\'est produit lors de la suppression des favoris ! </h2>';
        }
    }
    ?>

    <?php
    if ($produits) { ?>
        <div class="bg-card-section1 mt-5 mb-5">
            <div class="container">
                <!-- ligne Card 1 -->
                <div class="row mx-auto" id="AffichageProdFiltrees">
                    <div class="col-lg-12">
                        <h1 class="text-center mt-2">Mes Favoris</h1>
                    </div>

                    <!-- // ici On parcours le foreach pour récupérer les articles plus haut -->
                    <?php foreach ($produits as $produit) { ?>
                        <div class="col-lg-4 col-sm-6 mx-auto mt-5 mb-5">
                            <div class="card">
                                <form action="../controler/traitement_delete_favoris.php" method="post">
                                    <input type="hidden" name="idProduit" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="idFavoris" value="<?php echo htmlspecialchars($produit['id_favoris'], ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="action" value="suprimerFavoris">
                                    <button type="submit" class="nav-link ajout-favoris text-light d-flex">
                                        <i class="icon-favoris bi bi-heart-fill fs-3 mx-5 ml-auto mt-2 mb-2 text-danger"></i>
                                    </button>
                                </form>

                                <div class="card-img-top">

                                    <img src="../public/ressource/figurines/<?php echo $produit['logo'] ?>" class="img-card img-fluid mx-auto d-block" alt="<?php echo $produit['logo'] ?>">
                                    <div class="line"></div>
                                </div>

                                <div class="card-block d-flex flex-column bg-white text-dark">
                                    <h3 class="text-center mt-2 fs-2"><?php echo htmlspecialchars($produit['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
                                    <p class="text-center mt-2">Materiel : <?php echo htmlspecialchars($produit['materiel'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <p class="text-center mt-2">Taille : <?php echo htmlspecialchars($produit['taille'], ENT_QUOTES, 'UTF-8') ?> cm</p>
                                    <p class="text-center mt-2"><span class="span">Prix : <?php echo htmlspecialchars($produit['prix_unit'], ENT_QUOTES, 'UTF-8') ?> €</span></p>
                                    <p class="text-center mt-2">
                                        <!-- Condition qui vérifi les stock -->
                                        <?php if ($produit['stock'] < 1) : ?>
                                            <span class="span rupture">Rupture de stock</span>
                                        <?php else : ?>
                                            <span class="span">En Stock : <?php echo htmlspecialchars($produit['stock'], ENT_QUOTES, 'UTF-8') ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <a href="../public/index.php?page=4"><input type="submit" value="Afficher L'article" class="btn-card w-100 mt-2"></a>
                            <?php if ($produit['stock'] > 0) : ?>
                                <form action="../controler/traitement_panier.php" method="post">
                                    <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="action" value="ajoutProd">
                                    <input type="submit" value="Ajouter au Panier" class="btn-card w-100 mt-2">
                                </form>
                            <?php endif; ?>

                        </div>
                    <?php } ?>
                    <!-- // fin foreach -->
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="row mx-auto" id="AffichageProdFiltrees">
            <div class="bg-card-section1 mt-5 mb-5">
                <div class="col-lg-12">
                    <h3 class="text-center text-danger mt-2">Aucuns Favoris</h3>
                </div>
            </div>
        </div>
<?php }
} ?>