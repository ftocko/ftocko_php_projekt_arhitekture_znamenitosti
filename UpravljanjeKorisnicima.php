<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/Konfiguracija.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL ^ E_NOTICE);

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$user["korisnik"] = $korisnik["korisnik"];

if ($uloga === "2" || $uloga === "3" || $uloga === null) {

    header("Location:GlavniZaslon.php");
}

ProvjeraIstekaSesije();
$opcijeBlokiraniKorisnici = "";

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Upravljanje korisnicima";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

function FunkcijaStranicenjeBlokiranihKorisnika() {

    global $opcijeBlokiraniKorisnici;

    $baza = new Baza();
    $baza->spojiDB();
    $sqlUpit = "select * from korisnik where status=-1;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcijeBlokiraniKorisnici = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

if ($uloga === "2" || $uloga === "3" || $uloga === null) {

    header("Location:GlavniZaslon.php");
}

if (isset($_GET["korime"])) {
    

    $korime = $_GET["korime"];

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "update korisnik set broj_neuspjesnih_prijava = 0, status = 1 where korisnicko_ime = '$korime';";

    $baza->updateDB($upit);

    $baza->zatvoriDB();
    
    $dnevnik->radnja = "Korisnik $korime je deblokiran.";
    $dnevnik->tip_id_radnje = 14;
    $dnevnik->Zapisi($user);
}

if (isset($_POST["korisnik"])) {

    global $user;
    $config = new Konfiguracija();
    $broj_neuspjesnih_prijava = $config->DohvatiBrojPrijava();

    $korisnik = $_POST["korisnik"];

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "update korisnik set broj_neuspjesnih_prijava = $broj_neuspjesnih_prijava, status = -1 where korisnicko_ime = '$korisnik';";

    $baza->updateDB($upit);

    $baza->zatvoriDB();
    
    $dnevnik->radnja = "Korisnik $korisnik je blokiran.";
    $dnevnik->tip_id_radnje = 13;
    $dnevnik->Zapisi($user);
}

FunkcijaStranicenjeBlokiranihKorisnika();

$smarty->assign("opcijeBlokiraniKorisnici", $opcijeBlokiraniKorisnici);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("upravljanjeKorisnicima.tpl");
