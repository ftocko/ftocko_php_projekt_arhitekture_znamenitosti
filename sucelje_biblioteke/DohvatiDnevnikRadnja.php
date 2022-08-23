<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";


$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$radnja = $_GET["radnja"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];


if ($stranica == 1) {

    $sqlUpit = "SELECT d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and t.naziv_radnje = '$radnja' LIMIT $objekt->broj_podataka";
} else {

    $sqlUpit = "SELECT d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and t.naziv_radnje  = '$radnja' LIMIT $objekt->broj_podataka OFFSET $offset;";
}

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["dnevnik_id"] = $red["dnevnik_id"];
    $redak["korisnicko_ime"] = $red["korisnicko_ime"];
    $redak["naziv_radnje"] = $red["naziv_radnje"];
    $redak["datum_vrijeme"] = $red["datum_vrijeme"];
    $redak["radnja"] = $red["radnja"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

