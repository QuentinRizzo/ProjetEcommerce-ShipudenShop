<?php
session_start();
require "../model/connexion_bdd.php";
require "../model/fonctions.php";
require '../controler/pagination.php';

if (isset($_GET['tris'])) {
    $_SESSION['tris'] = $_GET['tris'];
    header('location:../public/index.php?page=1&tris=ok');
} else {
    header('location:../public/index.php?page=1');
    die();
}

