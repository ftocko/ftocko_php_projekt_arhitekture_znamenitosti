<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

$znamenitost = $_GET["znamenitost"];

$sqlUpit = "select concat(m.ime,' ',m.prezime) as kreirao, z.predlozio, z.godina from znamenitost z inner join korisnik m where m.korisnik_id = z.moderator_id AND z.naziv_znamenitosti = '$znamenitost';";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

if(mysqli_num_rows($rezultat)==0){
    
    $sqlUpit = "select moderator_id as kreirao, predlozio, godina from znamenitost where naziv_znamenitosti = '$znamenitost';";
    
}

else{
    $sqlUpit = "select concat(m.ime,' ',m.prezime) as kreirao, z.predlozio, z.godina from znamenitost z inner join korisnik m where m.korisnik_id = z.moderator_id AND z.naziv_znamenitosti = '$znamenitost';";
}

$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

while($objekt=mysqli_fetch_object($rezultat)){
    
    $redak["kreirao"] = $objekt->kreirao;
    $redak["predlozio"] = $objekt->predlozio;
    $redak["godina"] = $objekt->godina;
    
    $odgovor[] = $redak;
    
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);


