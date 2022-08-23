<?php

$direktorij = dirname( dirname(__FILE__) );
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "../biblioteke/Zaglavlje.php";
include_once "../biblioteke/stranicenje.class.php";
include_once "../DodavanjeZaHtaccess/Dodaj.php";


$opcije = "";
UpisiKorisnike();

function ProvjeraHttp() {

   if (isset($_SERVER["HTTPS"])||strtolower($_SERVER["HTTPS"]) == "on") {

        $adresaSkripte = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

        header("Location:$adresaSkripte");
    }

}

ProvjeraHttp();

function FunkcijaStranicenjeKorisnici() {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    $upit = "select k.korisnicko_ime, k.lozinka, u.naziv_uloga from korisnik k inner join uloga u where u.uloga_id = k.uloga_id and korisnicko_ime is not null;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($upit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

FunkcijaStranicenjeKorisnici();

$smarty->assign("opcije",$opcije);
$smarty->display("korisnici.tpl");
