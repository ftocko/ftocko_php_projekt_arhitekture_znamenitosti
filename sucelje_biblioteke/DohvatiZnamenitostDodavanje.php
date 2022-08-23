<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$id = $_GET["id"];

$sqlUpit = "select z.znamenitost_id,z.zahtjev_id,z.moderator_id,z.predlozio,z.naziv_znamenitosti,z.opis,z.godina,z.datum_i_vrijeme_dodavanja from znamenitost z where z.znamenitost_id = $id;";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

while($objekt=mysqli_fetch_object($rezultat)){
    
    $redak["znamenitost_id"] = $objekt->znamenitost_id;
    $redak["zahtjev_id"] = $objekt->zahtjev_id;
    $redak["moderator_id"] = $objekt->moderator_id;
    $redak["predlozio"] = $objekt->predlozio;
    $redak["naziv_znamenitosti"] = $objekt->naziv_znamenitosti;
    $redak["opis"] = $objekt->opis;
    $redak["godina"] = $objekt->godina;
    $redak["datum_i_vrijeme_dodavanja"] = $objekt->datum_i_vrijeme_dodavanja;
    
    $odgovor[] = $redak;
    
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);

