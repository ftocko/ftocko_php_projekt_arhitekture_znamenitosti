<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include_once "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();

function DohvatiIdKorisnika($korisnik) {

    $korisnikId;
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT korisnik_id FROM korisnik WHERE korisnicko_ime = '$korisnik';";
    $rezultat = $baza->selectDB($upit);

    while ($red = mysqli_fetch_array($rezultat)) {

        $korisnikId = $red["korisnik_id"];
    }

    $baza->zatvoriDB();
    return $korisnikId;
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Korisnik {$korisnik["korisnik"]} se odjavio iz sustava.";
$dnevnik->tip_id_radnje = 1;
$dnevnik->Zapisi($korisnik);


Sesija::obrisiSesiju();
header("Location:index.php");

