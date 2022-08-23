<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

error_reporting(E_ALL ^ E_NOTICE);

$objekt = new stranicenje();

$stranica = $_GET["stranica"];
$broj_stranica = $_GET["stranice"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];


if ($stranica == 1) {

    $sqlUpit = "SELECT * FROM grad LIMIT $objekt->broj_podataka;";
} else {
    $sqlUpit = "SELECT * FROM grad LIMIT $objekt->broj_podataka OFFSET $offset;";
}


$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["id"] = $red["grad_id"];
    $redak["naziv_grada"] = $red["naziv_grada"];
    $redak["naziv_zupanije"] = $red["naziv_zupanije"];
    $redak["gradonacelnik"] = $red["gradonacelnik"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

