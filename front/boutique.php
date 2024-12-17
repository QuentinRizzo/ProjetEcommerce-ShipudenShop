<?php
// session_start();
require "../model/connexion_bdd.php";
require '../controler/pagination.php';
?>

<!-- Faire un input de recherche avec des input de type number pour prix min et prix max et text pour-->

<h2 class="Title-h2 fs-1 text-dark">Nos Figurines</h2>
<p class="p-desc fs-4 text-dark">Retrouvez Toutes nos Figurines dès maintenant !</p>
<div class="row m-0">
    <div class="col-lg-12 mb-2 d-flex">
        <div class="d-block mx-4" id="recherchenom">
            <input class="inpRecherche text-center" type="search" id="input_rechercher" placeholder="Rechercher...">
        </div>
        <button class="btn-card h-100 btnRechercher" type="button" id="btnFiltre">Montrer filtres</button>
    </div>
</div>
<div class="row m-0">
    <div class="col-lg-3 mb-2 d-flex">
        <select name="trisParOrdres" id="trisParOrdres" class="form-select mt-2 select-bg" aria-label="Default select example">
            <option value="">Choisir L'ordre de Recherche :</option>
            <option value="ordreCroissant">Prix Croissant</option>
            <option value="ordreDecroissant">Prix Décroissant</option>
            <option value="alphabet">Recherche par ordre Alphabétique</option>
            <option value="default">Annuler le tri</option>
        </select>
    </div>
</div>

<div class="row d-none" id="filtres">
    <div class="col-lg-6 mx-2 d-flex">
        <input class="form-control mx-2 mt-2" type="number" placeholder="prix min" id="prixMin">
        <input class="form-control mx-2 mt-2" type="number" placeholder="prix max" id="prixMax">
        <input class="form-control mx-2 mt-2 btn-card p-2" name="searchBar" type="button" id="searchBar" value="Rechercher">
    </div>
</div>
<div class="box-presentation row w-100 mt-5">
    <?php
    if (isset($_GET['sucess'])) {

        if ($_GET['sucess'] == 'AjouterAuFavoris') {
            echo '<h2 class="text-center text-success">Le produit a été ajouter a vos Favoris ! </h2>';
        }
    }
    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'AjouterAuFavorisErreur') {
            echo '<h2 class="text-center text-danger">Une erreur c\'est produit veuillez réesayer ! </h2>';
        }
    }
    ?>
</div>

<div class="bg-card-section1 mt-5 mb-5">
    <div class="container">
        <!-- ligne Card 1 -->
        <div class="row mx-auto" id="AffichageProdFiltrees">
            <!-- // ici On parcours le foreach pour récupérer les articles plus haut -->
            <?php 
                foreach ($produits as $produit) { ?>
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
                        <form action="../public/index.php?page=4" method="post">
                            <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="submit" value="Afficher le Produit" class="btn-card w-100 mt-2">
                        </form>


                        <?php if ($produit['stock'] > 0) : ?>
                            <form action="../controler/traitement_panier.php" method="post">
                                <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="action" value="ajoutProd">
                                <input type="submit" value="Ajouter au Panier" class="btn-card w-100 mt-2">
                            </form>
                        <?php endif; ?>
                    </div>
            <?php }
             ?>
            <!-- // fin foreach -->

            <!-- Début de la pagination -->
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center justify-content-center" id="pagination">
                    <?php for ($i = 1; $i <= $nbPages; $i++) {
                        echo '<a class="text-decoration-none icon-card mt-5 text-dark mx-2 fs-5" href="index.php?page=1&num_page=' . $i . '">' . $i . '</a>';
                    } ?>
                </div>
            </div>
            <!-- Fin de la pagination -->
        </div>
    </div>
</div>