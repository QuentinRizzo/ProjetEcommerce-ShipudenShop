<?php
session_start();
require "../model/connexion_bdd.php";
require "../model/fonctions.php";
$infosUser = RecupFactureInfosUser($pdo, $id_facturation, $_SESSION['idUser']);
$idPan = $infosUser['id_panier'];
$factures = recupInfosFacture($pdo, $idPan, $_SESSION['idUser']);
$fraisPort = recupFraisDePorts($pdo);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 10px 20px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .infos {
            width: 100%;
            margin-bottom: 20%;
        }

        .fright {
            float: right;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 0.8em;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="infos">
        <div>
            <strong>Émetteur:</strong><br>
            ShipudenShop<br>
            29B rue du general Metman<br>
            57070, Metz<br>
            06.45.78.85.64<br>
            agence.shippudenShop.com<br>
        </div>

        <div class="fright">


            <strong>Facture n°:</strong><?php echo $infosUser['num_facture']; ?><br>
            <strong>Date:</strong> <?php echo date('d-m-Y'); ?><br>
            <strong>Destinataire:</strong><br>
            <?php echo htmlspecialchars($infosUser['nom'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($infosUser['prenom'], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php echo htmlspecialchars($infosUser['adresse'], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php echo htmlspecialchars($infosUser['nom_ville'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($infosUser['code_postal'], ENT_QUOTES, 'UTF-8'); ?><br>

        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
                <th>Frais Livraison</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($factures as $facture) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($facture['titre'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?php echo htmlspecialchars($facture['qte_com'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?php echo htmlspecialchars($facture['prix_unit'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?php echo htmlspecialchars($facture['prix_unit'], ENT_QUOTES, 'UTF-8') * htmlspecialchars($facture['qte_com'], ENT_QUOTES, 'UTF-8'); ?> €</td>
                    <td></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Montant Total: <?php echo htmlspecialchars($factures[0]['prix_total'], ENT_QUOTES, 'UTF-8')?> €</strong></td>
                <td></td>
                <td><strong>Frais de Ports : <?php echo htmlspecialchars($fraisPort['montant'], ENT_QUOTES, 'UTF-8') ?> €</strong></td>
            </tr>

        </tbody>

    </table>

    <div class="footer">
        ShippudenShop - SIRET: 777 888 999 00022 - Autres informations
    </div>

</body>

</html>