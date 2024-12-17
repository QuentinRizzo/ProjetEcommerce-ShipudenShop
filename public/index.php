<!DOCTYPE html>
<html class="h-100" lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Figurine manga.">
    <title>ShipudenShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/ressource/css/style.css">
</head>

<body>
    <?php
    session_start();
    include('../front/header.php');

    if (isset($_GET['page'])) {
        if ($_GET['page'] == 1) {
            include "../front/boutique.php";
        }
        if ($_GET['page'] == 3) {
            include "../front/contact.php";
        }
        if ($_GET['page'] == 4) {
            include "../front/details_article.php";
        }
        if ($_GET['page'] == 6) {
            include "../front/pannier.php";
        }
        if ($_GET['page'] == 7) {
            include "../front/monProfil.php";
        }
        if ($_GET['page'] == 8) {
            include "../front/facture_client.php";
        }
        if ($_GET['page'] == 9) {
            include "../front/verification_email.php";
        }
        if ($_GET['page'] == 10) {
            include "../front/nouv_mdp.php";
        }
        if ($_GET['page'] == 11) {
            include "../front/favoris.php";
        }
    } else {
        include "../front/accueil.php";
    }

    include('../front/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="../public/ressource/js/script.js"></script>
</body>

</html>