<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";


$objekt = new stranicenje();

$grad = $_GET["grad"];
$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$znamenitost = $_GET["znamenitost"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];

if (isset($_GET["znamenitost"])) {
    
    
     $sqlUpit = "select g.naziv_grada, zn.naziv_znamenitosti from grad g inner join zahtjev z on z.grad_id = g.grad_id inner join znamenitost zn on zn.zahtjev_id = z.zahtjev_id where g.naziv_grada = '$grad' and zn.naziv_znamenitosti = '$znamenitost';";
    
} else {

    if ($stranica == 1) {

        $sqlUpit = "select g.naziv_grada, zn.naziv_znamenitosti from grad g inner join zahtjev z on z.grad_id = g.grad_id inner join znamenitost zn on zn.zahtjev_id = z.zahtjev_id where g.naziv_grada = '$grad' LIMIT $objekt->broj_podataka;";
    } else {

        $sqlUpit = "select g.naziv_grada, zn.naziv_znamenitosti from grad g inner join zahtjev z on z.grad_id = g.grad_id inner join znamenitost zn on zn.zahtjev_id = z.zahtjev_id where g.naziv_grada = '$grad' LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
}



$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["naziv_znamenitosti"] = $red["naziv_znamenitosti"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

