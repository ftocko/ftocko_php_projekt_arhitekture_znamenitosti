<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$sqlUpit = "select k.korisnicko_ime, g.naziv_grada from korisnik k, grad g, upravljanje_gradom u where k.korisnik_id = u.moderator_id and g.grad_id = u.grad_id;";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

while($objekt=mysqli_fetch_object($rezultat)){
   
    $redak["korisnicko_ime"] = $objekt->korisnicko_ime;
    $redak["naziv_grada"] = $objekt->naziv_grada;
    $odgovor[] = $redak;
    
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);



