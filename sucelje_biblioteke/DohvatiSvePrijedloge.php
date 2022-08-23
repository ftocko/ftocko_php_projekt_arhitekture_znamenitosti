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
    
    $sqlUpit = "select p.prijedlog_id, g.naziv_grada, p.naziv_znamenitosti, p.opis_znamenitosti, p.nadimak, p.ime_prezime from grad g inner join prijedlog p where g.grad_id = p.grad_id order by 1 LIMIT $objekt->broj_podataka;";
    
}

else{
    $sqlUpit = "select p.prijedlog_id, g.naziv_grada, p.naziv_znamenitosti, p.opis_znamenitosti, p.nadimak, p.ime_prezime from grad g inner join prijedlog p where g.grad_id = p.grad_id order by 1 LIMIT $objekt->broj_podataka OFFSET $offset;";
}


$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["prijedlog_id"] = $red["prijedlog_id"];
    $redak["naziv_grada"] = $red["naziv_grada"];
    $redak["naziv_znamenitosti"] = $red["naziv_znamenitosti"];
    $redak["opis_znamenitosti"] = $red["opis_znamenitosti"];
    $redak["nadimak"] = $red["nadimak"];
    $redak["ime_prezime"] = $red["ime_prezime"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);







