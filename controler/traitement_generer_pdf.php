<?php
require '../vendor/autoload.php';


use Dompdf\Dompdf;
use Dompdf\Options;

ob_start();

$id_facturation = filter_input(INPUT_GET, 'idFacture', FILTER_SANITIZE_NUMBER_INT);
include '../front/facture_pdf.php';
$html = ob_get_clean();


$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream('facture.pdf', array('Attachment' => 0));
