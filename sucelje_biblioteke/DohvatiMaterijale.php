<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje_galerije.class.php";

$godina = "";
$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$godina = $_GET["godina"];
$objekt = new stranicenjeGalerija();
settype($godina,"integer");

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];


if (isset($_GET["godina"])) {
    
    if ($stranica == 1) {
        
        $sqlUpit = "select m.naziv_materijala, m.tip_materijal_id, m.putanja from materijal m, znamenitost z where z.znamenitost_id = m.znamenitost_id and z.godina = $godina LIMIT $objekt->broj_podataka;";
        
    }
    
    else{
        $sqlUpit = "select m.naziv_materijala, m.tip_materijal_id, m.putanja from materijal m, znamenitost z where z.znamenitost_id = m.znamenitost_id and z.godina = $godina LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
    
} else {

    if ($stranica == 1) {
        $sqlUpit = "select naziv_materijala,tip_materijal_id,putanja from materijal LIMIT $objekt->broj_podataka;";
    } else {
        $sqlUpit = "select naziv_materijala,tip_materijal_id,putanja from materijal LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
}

$baza = new Baza();
$baza->spojiDB();
$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

while ($objekt = mysqli_fetch_object($rezultat)) {

    $redak["naziv_materijala"] = $objekt->naziv_materijala;
    $redak["putanja"] = $objekt->putanja;
    $redak["tip"] = $objekt->tip_materijal_id;

    $odgovor[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);



