<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$sort = $_GET["sort"];

$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];

if (!isset($_GET["sort"])) {

    if ($stranica == 1) {
        $sqlUpit = "SELECT naziv_grada, count(*) from grad, zahtjev, znamenitost where grad.grad_id = zahtjev.grad_id and zahtjev.zahtjev_id = znamenitost.zahtjev_id and zahtjev.status = 'potvrdjeno' group by naziv_grada LIMIT $objekt->broj_podataka;";
    } else {
        $sqlUpit = "SELECT naziv_grada, count(*) from grad, zahtjev, znamenitost where grad.grad_id = zahtjev.grad_id and zahtjev.zahtjev_id = znamenitost.zahtjev_id and zahtjev.status = 'potvrdjeno' group by naziv_grada LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
}


if(isset($_GET["sort"])&&$sort==="brojZnamenitosti"){
    
     if($stranica==1){
        $sqlUpit = "SELECT naziv_grada, count(*) from grad, zahtjev, znamenitost where grad.grad_id = zahtjev.grad_id and zahtjev.zahtjev_id = znamenitost.zahtjev_id and zahtjev.status = 'potvrdjeno' group by naziv_grada order by 2 desc LIMIT $objekt->broj_podataka;";   
    }
    
    else{
        $sqlUpit = "SELECT naziv_grada, count(*) from grad, zahtjev, znamenitost where grad.grad_id = zahtjev.grad_id and zahtjev.zahtjev_id = znamenitost.zahtjev_id and zahtjev.status = 'potvrdjeno' group by naziv_grada order by 2 desc LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
}


$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["naziv_grada"] = $red["naziv_grada"];
    $redak["broj_znamenitosti"] = $red["count(*)"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

