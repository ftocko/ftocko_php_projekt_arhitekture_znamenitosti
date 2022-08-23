<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$objekt = new stranicenje();

$stranica = $_GET["page"];
$broj_stranica = $_GET["pages"];
$user = $_GET["user"];
$vrijemeOd = $_GET["vrijemeOd"];
$vrijemeDo = $_GET["vrijemeDo"];


$objekt->broj_stranica = $broj_stranica;
$objekt->SetPoljePomaka();
$offset = $objekt->polje_pomaka[$stranica];

if (isset($_GET["user"])) {
   

    if ($stranica == 1) {
        if($user=="null"){
           $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime is null group by stranica LIMIT $objekt->broj_podataka;"; 
        }
        
        else{
            $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime = '$user' group by stranica LIMIT $objekt->broj_podataka;";
        }
        
    } else {
        
        if($user=="null"){
            $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime is null group by stranica LIMIT $objekt->broj_podataka OFFSET $offset;";
        }
        
        else{
             $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime = '$user' group by stranica LIMIT $objekt->broj_podataka OFFSET $offset;";
        }
       
    }
}


else if (isset($_GET["vrijemeOd"])) {
   

    if ($stranica == 1) {
        $sqlUpit = "select radnja as stranica, count(korisnik_id) as broj_pristupa from dnevnik where tip_id = 5 and datum_vrijeme between '$vrijemeOd' and '$vrijemeDo' group by stranica LIMIT $objekt->broj_podataka;";
    } else {
        $sqlUpit = "select radnja as stranica, count(korisnik_id) as broj_pristupa from dnevnik where tip_id = 5 and datum_vrijeme between '$vrijemeOd' and '$vrijemeDo' group by stranica LIMIT $objekt->broj_podataka OFFSET $offset;";
    }
}


else {
    if ($stranica == 1) {
        $sqlUpit = "select radnja as stranica, count(korisnik_id) as broj_pristupa from dnevnik where tip_id = 5 group by stranica LIMIT $objekt->broj_podataka;";
    } else {
        $sqlUpit = "select radnja as stranica, count(korisnik_id) as broj_pristupa from dnevnik where tip_id = 5 group by stranica LIMIT $objekt->broj_podataka OFFSET $offset;";
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














