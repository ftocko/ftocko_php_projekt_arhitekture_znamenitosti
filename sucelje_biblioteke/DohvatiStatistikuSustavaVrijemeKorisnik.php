<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$user = $_GET["user"];
$timeOd = $_GET["vrijemeOd"];
$timeDo = $_GET["vrijemeDo"];


$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];


if ($stranica == 1) {
    
    if($user=="null"){
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime is null and (dnevnik.datum_vrijeme between '$timeOd' and '$timeDo') group by stranica LIMIT $objekt->broj_podataka;";
    }
    
    else{
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime = '$user' and (dnevnik.datum_vrijeme between '$timeOd' and '$timeDo') group by stranica LIMIT $objekt->broj_podataka;";
    }
    
} else {
    
    if($user=="null"){
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime is null and (dnevnik.datum_vrijeme between '$timeOd' and '$timeDo') group by stranica LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
    
    else{
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime = '$user' and (dnevnik.datum_vrijeme between '$timeOd' and '$timeDo') group by stranica LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
    
}


$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["stranica"] = $red["stranica"];
    $redak["broj_pristupa"] = $red["broj_pristupa"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

