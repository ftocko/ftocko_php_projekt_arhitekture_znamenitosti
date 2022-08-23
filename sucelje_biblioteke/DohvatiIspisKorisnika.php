<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

error_reporting(E_ALL ^ E_NOTICE);

$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];


if ($stranica == 1) {

    $sqlUpit = "select k.korisnicko_ime, k.lozinka, k.ime, k.prezime, k.email, u.naziv_uloga from korisnik k inner join uloga u where u.uloga_id = k.uloga_id and korisnicko_ime is not null LIMIT $objekt->broj_podataka;";
} else {
    $sqlUpit = "select k.korisnicko_ime, k.lozinka, k.ime, k.prezime, k.email, u.naziv_uloga from korisnik k inner join uloga u where u.uloga_id = k.uloga_id and korisnicko_ime is not null LIMIT $objekt->broj_podataka OFFSET $offset;";
}


$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["korisnicko_ime"] = $red["korisnicko_ime"];
    $redak["lozinka"] = $red["lozinka"];
    $redak["naziv_uloga"] = $red["naziv_uloga"];
    $redak["ime"] = $red["ime"];
    $redak["prezime"] = $red["prezime"];
    $redak["email"] = $red["email"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);



