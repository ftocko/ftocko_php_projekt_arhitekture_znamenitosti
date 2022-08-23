<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$opcijeGradovi = "";

ProvjeraIstekaSesije();


if ($korisnik == null) {
    header("Location:index.php");
}

if ($uloga === "2" || $uloga === "3") {

    header("Location:Gradovi.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Dodavanje gradova";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if (isset($_POST["submit"])) {
    
    global $korisnik;

    $baza = new Baza();
    $baza->spojiDB();

    $nazivGrada = "";
    $nazivZupanije = "";
    $gradonacelnik = "";

    $nazivGrada = $_POST["nazivGrada"];
    $nazivZupanije = $_POST["nazivZupanije"];
    $gradonacelnik = $_POST["imePreGradonacelnika"];

    $upit = "INSERT INTO grad(naziv_grada,naziv_zupanije,gradonacelnik) VALUES ('$nazivGrada','$nazivZupanije','$gradonacelnik');";

    if ($nazivGrada === "" || $nazivZupanije === "" || $gradonacelnik === "") {

        $poruka = "Niste unijeli sve podatke za unos grada!";
    } else {

        $rezultat = $baza->InsertDB($upit);
        $poruka = "Uspješno ste dodali novi grad!";
    }

    $baza->zatvoriDB();

    $dnevnik = new Dnevnik();
    $dnevnik->radnja = "Dodan je novi grad $nazivGrada.";
    $dnevnik->tip_id_radnje = 12;
    $dnevnik->Zapisi($korisnik);
}

function FunkcijaStranicenjeGradovi() {

    global $opcijeGradovi;
    $baza = new Baza();
    $baza->spojiDB();
    $sqlUpit = "SELECT * FROM grad;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcijeGradovi = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

FunkcijaStranicenjeGradovi();

$smarty->assign("opcijeGradovi", $opcijeGradovi);
$smarty->assign("poruka", $poruka);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("dodavanjeGradova.tpl");

