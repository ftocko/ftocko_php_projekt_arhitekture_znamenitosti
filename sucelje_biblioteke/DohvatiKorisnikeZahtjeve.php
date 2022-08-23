<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$upit = $_GET["upit"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];


if($stranica==1){
    
    $sqlUpit = $upit . " LIMIT $objekt->broj_podataka;";
}

else{
    $sqlUpit = $upit . " LIMIT $objekt->broj_podataka OFFSET $offset;";
}

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["korisnicko_ime"] = $red["korisnicko_ime"];
    $redak["broj_zahtjeva"] = $red["broj_zahtjeva"];
    $redak["status_zahtjev"] = $red["status_zahtjev"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);



