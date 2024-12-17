<!-- Ajout des produit au pannier -->
<?php
session_start();


require '../model/connexion_bdd.php';
require '../model/fonctions.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'ajoutProd') {
        // récupérer de la vue l'id et la quantité du produit sur lequel on a cliqué
        $qte_com = 1;
        $id_produit = filter_input(INPUT_POST, 'idProd', FILTER_SANITIZE_NUMBER_INT);
        $produit = verifFigurine($pdo, $id_produit);
        date_default_timezone_set('Europe/Paris');
        $date_panier = date('Y-m-d H:i:s');
        $prix_total = $produit['prix_unit'] * $qte_com;
        $prix_unit = $produit['prix_unit'];

        if (isset($_SESSION['idPanier'])) {
            // appel de la  fonction qui vérifi si le produit existe dans le panier :
            $produitExist =  produitExistePanier($pdo, $id_produit, $_SESSION['idPanier']);

            if ($produitExist) {
                updateQteProduit($pdo, $qte_com, $id_panier, $id_produit);
            } else {
                insertDetailPanier($pdo, $id_produit, $_SESSION['idPanier'], $qte_com, $prix_unit);
            }
            updateMontantPanier($pdo, $_SESSION['idPanier'], $prix_total);
        } else {

            if (isset($_SESSION['idUser'])) {
                createPanierUser($pdo, $date_panier, $prix_total, $_SESSION['idUser']);
            } else {
                createPanier($pdo, $date_panier, $prix_total);
            }

            $_SESSION['idPanier'] = $pdo->lastInsertId();
            insertDetailPanier($pdo, $id_produit, $_SESSION['idPanier'], $qte_com, $prix_unit);
        }
        header('Location:../public/index.php?page=6&sucess=ajouterAuPanier');
    }

    if ($_POST['action'] == 'payerPan') {
        if (isset($_SESSION['idUser'])) {
            if (isset($_SESSION['idPanier'])) {
                $recupAdressUser = recupInfosUsers($pdo, $_SESSION['idUser']);
                $id_adresse = $recupAdressUser['id_adresse'];
                date_default_timezone_set('Europe/Paris');
                $date_facture = date('Y-m-d H:i:s');
                $annee_courant = date('Y');
                $mois_courant = date('M');
                $factureExist = recupNumFactIdMax($pdo);
                $id_bon = filter_input(INPUT_POST, 'BonReduction', FILTER_SANITIZE_NUMBER_INT);
    
                if (!$factureExist) {
                    $num = 1;
                    $num_facture = 'shpdn' . $mois_courant . $annee_courant . '_' . '00' . $num;
                    insertFacture($pdo, $num_facture, $date_facture, $id_adresse, $_SESSION['idPanier'], $_SESSION['idUser'], $id_bon);
                    unset($_SESSION['idPanier']);
                    header('Location:../public/index.php?page=6&sucess=pannierSupp');
                } else {
                    $tabFacture = explode('_', $factureExist['num_facture']);
                    $num = intval($tabFacture[1] + 1);
                    $num_facture = 'shpdn' . $mois_courant . $annee_courant . '_' . '00' . $num;
                    insertFacture($pdo, $num_facture, $date_facture, $id_adresse, $_SESSION['idPanier'], $_SESSION['idUser'], $id_bon);
                    unset($_SESSION['idPanier']);
                    header('Location:../public/index.php?page=6&sucess=pannierSupp');
                }
                header('Location:../public/index.php?page=6&sucess=panierPayer');
            } else {
                header('Location:../public/index.php?page=6&sucess=AucunPanierExiste');
            }
        } else {
            header('Location:../public/index.php?&error=userDeconnecter');
        }
    }
} else {
    header('Location:../public/index.php?page=6&erreur=panierNonPayer');
}


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'supprimerProd') {
        // $id_produit = $_GET['idProd'];
        $id_produit = filter_input(INPUT_GET, 'idProd', FILTER_SANITIZE_NUMBER_INT);
        $produit =  produitExistePanier($pdo, $id_produit, $_SESSION['idPanier']);

        $montantProduitASupprimer = - ($produit['prix_unit'] * $produit['qte_com']);
        suprimerProdPan($pdo, $_GET['idProd'], $_SESSION['idPanier']);
        header('Location:../public/index.php?page=6&sucess=suprimerProdPan');

        // il faut appeler une fonction qui retourne le nombre de produits dans le panier en cours
        $verifprod = recupNbProdPaniers($pdo, $_SESSION['idPanier']);

        if ($verifprod == 0) {
            // il faut supprimer aussi son id de la session
            SuprimePanier($pdo, $_SESSION['idPanier']);
            header('Location:../public/index.php?page=6&sucess=suprimerPanier');
            header('Location:../public/index.php?page=6');
            // Supprimer le panier de la session aussi
            unset($_SESSION['idPanier']);
        } else {
            // on met à jour le montant du panier
            updateMontantPanier($pdo, $_SESSION['idPanier'], $montantProduitASupprimer);
        }
    }
}
