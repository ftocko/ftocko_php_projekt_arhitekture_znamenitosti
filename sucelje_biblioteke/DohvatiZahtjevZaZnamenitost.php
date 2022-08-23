<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$id = $_GET["id"];

function DohvatiPredlozitelja() {

    global $id;
    $baza = new Baza();
    $baza->spojiDB();
    $upit = "select p.nadimak, p.ime_prezime from prijedlog p, zahtjev z where p.prijedlog_id = z.prijedlog_id and z.zahtjev_id = $id;";
    $rez = $baza->selectDB($upit);
    $predlozio = array();
    
    while($red = mysqli_fetch_array($rez)){
        
        $predlozio[0] = $red["nadimak"];
        $predlozio[1] = $red["ime_prezime"];
    }

    $baza->zatvoriDB();
    return $predlozio;
}

$sqlUpit = "select zahtjev_id, naziv_znamenitosti, opis_znamenitosti, godina_znamenitosti from zahtjev where zahtjev_id = $id;";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

$predlozio = DohvatiPredlozitelja();
$predlozioNadimak = "";
$predlozioImePrezime = "";
$predlozioNadimak = $predlozio[0];
$predlozioImePrezime= $predlozio[1];
$predlozitelj = "";

if($predlozioNadimak===""&&$predlozioImePrezime!==""){
    
    $predlozitelj = $predlozioImePrezime;
    
}

else if ($predlozioNadimak!==""&&$predlozioImePrezime===""){
    
    $predlozitelj = $predlozioNadimak;
}

else{
    $predlozitelj = $predlozioNadimak;
}


while ($objekt = mysqli_fetch_object($rezultat)) {

    $redak["zahtjev_id"] = $objekt->zahtjev_id;
    $redak["naziv_znamenitosti"] = $objekt->naziv_znamenitosti;
    $redak["opis_znamenitosti"] = $objekt->opis_znamenitosti;
    $redak["godina_znamenitosti"] = $objekt->godina_znamenitosti;
    $redak["predlozio"] = $predlozitelj;

    $odgovor[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);

