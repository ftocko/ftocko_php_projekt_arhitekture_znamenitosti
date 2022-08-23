<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

error_reporting(E_ALL^E_NOTICE);

$sqlUpit = "SELECT naziv_znamenitosti FROM znamenitost;";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["znamenitost"] = $red["naziv_znamenitosti"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

