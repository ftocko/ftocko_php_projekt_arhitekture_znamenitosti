<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];

if($stranica==1){
    
    $sqlUpit = "select z.zahtjev_id,k.korisnicko_ime, g.naziv_grada, z.naziv_znamenitosti, z.opis_znamenitosti, z.godina_znamenitosti, z.status from zahtjev z, korisnik k, grad g where g.grad_id = z.grad_id and k.korisnik_id = z.registrirani_korisnik_id order by 1 LIMIT $objekt->broj_podataka;";
}

else{
    $sqlUpit = "select z.zahtjev_id,k.korisnicko_ime, g.naziv_grada, z.naziv_znamenitosti, z.opis_znamenitosti, z.godina_znamenitosti, z.status from zahtjev z, korisnik k, grad g where g.grad_id = z.grad_id and k.korisnik_id = z.registrirani_korisnik_id order by 1 LIMIT $objekt->broj_podataka OFFSET $offset;";
}

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["zahtjev_id"] = $red["zahtjev_id"];
    $redak["korime"] = $red["korisnicko_ime"];
    $redak["naziv_grada"] = $red["naziv_grada"];
    $redak["naziv_znamenitosti"] = $red["naziv_znamenitosti"];
    $redak["opis_znamenitosti"] = $red["opis_znamenitosti"];
    $redak["godina_znamenitosti"] = $red["godina_znamenitosti"];
    $redak["status"] = $red["status"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);





