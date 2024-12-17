<?php
    session_start();
    $panierMemoire = $_SESSION['idPanier'];
    session_destroy();
    session_start();
    $_SESSION['idPanier'] = $panierMemoire;
    header('Location:../public/index.php');
    