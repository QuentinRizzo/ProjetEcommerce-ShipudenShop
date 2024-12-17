<?php
require "../model/connexion_bdd.php";
require "../model/fonctions.php";
require '../controler/pagination.php';
session_start();
if (isset($_POST['action'])) {

    if ($_POST['action'] == 'selectvilledept') {
        $idDept = filter_input(INPUT_POST, 'idDepartement', FILTER_SANITIZE_NUMBER_INT);
        $villesDept = recupVillesDept($pdo, $idDept);

        echo json_encode($villesDept);
    }

    // Ajouter et retirer un article dynamiquement du panier \\
    if (isset($_SESSION['idPanier'])) {
        if ($_POST['action'] == 'plusArticles' || $_POST['action'] == 'moinsArticles') {
            $id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_SANITIZE_NUMBER_INT);
            $recupProduit = verifFigurine($pdo, $id_produit);
            $prixProduitAajouterouAdeduire = $recupProduit['prix_unit'];
            $recupFraisPort = recupFraisDePorts($pdo);
            $montantPanier = recupMontantPanier($pdo, $_SESSION['idPanier']);
            $qte = 1;

            if ($_POST['action'] == 'moinsArticles') {
                $prixProduitAajouterouAdeduire = -$recupProduit['prix_unit'];
                $qte = -1;
            }

            updateQteProduit($pdo, $_SESSION['idPanier'], $id_produit, $qte);
            updateMontantPanier($pdo, $_SESSION['idPanier'], $prixProduitAajouterouAdeduire);

            $nouveauMntPanier = (int)$montantPanier + (int)$prixProduitAajouterouAdeduire;
            $reponse = ['montantPanier' => $nouveauMntPanier, 'montantMin' => $recupFraisPort['montant_min'], 'fraisLivr' => $recupFraisPort['montant']];
            echo json_encode($reponse);
        }
    }

    // Recherche dynamique des produits \\
    if ($_POST['action'] == 'searchBar' || $_POST['action'] == 'searchByPrice') {

        if ($_POST['action'] == 'searchBar') {
            $motCle = $_POST['motCle'];
            $rechercheProduit = rechercheFigurinesParNom($pdo, $motCle);
        }
        if ($_POST['action'] == 'searchByPrice') {
            $prixmin = $_POST['min'];
            $prixmax = $_POST['max'];
            $rechercheProduit = rechercherProduitParPrix($pdo, $prixmin, $prixmax);
        }
        if (count($rechercheProduit) == 0) {
            $reponse = '<p class="text-center alert alert-danger mt-3">Aucuns Produits n\'a été trouver !</p>';
        } else {
            $reponse = '';
            foreach ($rechercheProduit as $prod) {
                $reponse .= '<div class="container col-lg-4 col-sm-6 mx-auto mt-5 mb-5">';
                $reponse .= '<div class="card">';
                $reponse .= '<a class="nav-link ajout-favoris text-light d-flex flex-column justify-content-end align-items-end me-3" href="#"><i class="icon-card bi bi-heart fs-3"></i>Ajouter au Favoris</a>';
                $reponse .= '<div class="card-img-top">';
                $reponse .= '<img src="../public/ressource/figurines/' . $prod['logo'] . '" class="img-card img-fluid mx-auto d-block" alt="' . $prod['logo'] . '">';
                $reponse .= '<div class="line"></div></div>';
                $reponse .= '<div class="card-block d-flex flex-column bg-white text-dark">';
                $reponse .= '<h3 class="text-center mt-2 fs-2">' . $prod['titre'] . '</h3>';
                $reponse .= '<p class="text-center mt-2">' . 'Materiel :' . ' ' . $prod['materiel'] . '</p>';
                $reponse .= '<p class="text-center mt-2">' . 'Taille :' . ' ' . $prod['taille'] . '</p>';
                $reponse .= '<p class="text-center mt-2">' . 'Prix :' . ' ' . $prod['prix_unit'] . '</p>';
                
                if ($prod['stock'] == 0) {
                    $reponse .= '<p class="text-center mt-2"><span class="span text-danger">' . 'Stock :' . ' '. 'En rupture de stock';
                    $reponse .= '<a href="../public/index.php?page=4"><input type="submit" value="Afficher L\'article" class="btn-card w-100 mt-2"></a>';
                } else {
                    $reponse .= '<p class="text-center mt-2"><span class="span">' . 'Stock :' . ' ' . $prod['stock'];
                    $reponse .= '<a href="../public/index.php?page=4"><input type="submit" value="Afficher L\'article" class="btn-card w-100 mt-2"></a>';
                    $reponse .= '<input type="submit" value="Ajouter au Panier" class="btn-card w-100 mt-2">';
                }
                $reponse .= '</span></p>';
                $reponse .= '</div></div></div>';
            }
        }
        echo json_encode($reponse);
    }
}
