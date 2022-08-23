<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";

if(isset($_GET["podatak"])){
    
    $sqlUpit = "select * from korisnik where status!=0;";
    
}

else if(isset($_GET["param"])){
    
    $sqlUpit = "select * from korisnik;";
}

else{
    $sqlUpit = "select * from korisnik where status!=0 and status!=-1;";
}

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);

$odgovor = array();

while($objekt=mysqli_fetch_object($rezultat)){
   
    $redak["korime"] = $objekt->korisnicko_ime;
    $odgovor[] = $redak;
    
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($odgovor);

