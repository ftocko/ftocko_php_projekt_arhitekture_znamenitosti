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
    
    $sqlUpit = "select * from korisnik where status=-1 LIMIT $objekt->broj_podataka;";
}

else{
    $sqlUpit = "select * from korisnik where status=-1 LIMIT $objekt->broj_podataka OFFSET $offset;";
}

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

while($objekt=mysqli_fetch_object($rezultat)){
    
    $redak["ime"] = $objekt->ime;
    $redak["prezime"] = $objekt->prezime;
    $redak["korime"] = $objekt->korisnicko_ime;
    $redak["email"] = $objekt->email;
    $redak["status"] = $objekt->status;
    
    $odgovor[] = $redak;
    
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);

