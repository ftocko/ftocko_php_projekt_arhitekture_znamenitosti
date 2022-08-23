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

    $redak["id"] = $red["znamenitost_id"];
    $redak["zahtjev_id"] = $red["zahtjev_id"];
    $redak["moderator"] = $red["korisnicko_ime"];
    $redak["predlozio"] = $red["predlozio"];
    $redak["naziv"] = $red["naziv_znamenitosti"];
    $redak["godina"] = $red["godina"];
    $redak["datum_vrijeme"] = $red["datum_i_vrijeme_dodavanja"];
    $redak["opis"] = $red["opis"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);









