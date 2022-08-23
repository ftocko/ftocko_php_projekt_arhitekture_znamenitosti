<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";


$sqlUpit = "select distinct naziv_radnje from tip;";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["naziv_radnje"] = $red["naziv_radnje"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

