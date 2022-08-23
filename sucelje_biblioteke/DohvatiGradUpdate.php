<?php

ob_start();

include "../biblioteke/baza.class.php";

$grad = $_GET["grad"];

$sqlUpit = "SELECT * FROM grad WHERE naziv_grada = '$grad';";

$baza = new Baza();
$baza->spojiDB();

$rezultat = $baza->selectDB($sqlUpit);
$niz = array();

while ($red = mysqli_fetch_array($rezultat)) {

    $redak["naziv_grada"] = $red["naziv_grada"];
    $redak["naziv_zupanije"] = $red["naziv_zupanije"];
    $redak["gradonacelnik"] = $red["gradonacelnik"];

    $niz[] = $redak;
}

$baza->zatvoriDB();

ob_end_clean();

header("Content-Type: application/json");
echo json_encode($niz);

