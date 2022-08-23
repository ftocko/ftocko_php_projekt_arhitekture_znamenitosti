<?php

ob_start();

include "../biblioteke/baza.class.php";
include "../biblioteke/stranicenje.class.php";


$sqlUpit = "select distinct datum_vrijeme from dnevnik order by 1;";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["datum_vrijeme"] = $red["datum_vrijeme"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

