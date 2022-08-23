<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL ^ E_NOTICE);
$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$username = $korisnik["korisnik"];

if ($korisnik !== null) {

    ProvjeraIstekaSesije();

    
}

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


$korisnikId = 0;
$dnevnik = new dnevnik();
$korimeDnevnik = $korisnik["korisnik"];

if($korimeDnevnik===null){
    
    $korisnikId = 22;
}

else{
    $korisnikId = DohvatiIdKorisnika($korimeDnevnik);
}

$dnevnik->korisnik_id = $korisnikId;
$dnevnik->radnja = "Gradovi";
$dnevnik->tip_id_radnje = 5;
$dnevnik->ZapisiUDnevnik();

$opcije = "";
$opcijeGradovi = "";

function FunkcijaStranicenjeStatistike() {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    $sqlUpit = "SELECT naziv_grada, count(*) from grad, zahtjev, znamenitost where grad.grad_id = zahtjev.grad_id and zahtjev.zahtjev_id = znamenitost.zahtjev_id and zahtjev.status = 'potvrdjeno' group by naziv_grada;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeOdabiraGradova() {

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

FunkcijaStranicenjeOdabiraGradova();
FunkcijaStranicenjeStatistike();

$smarty->assign("ispis",$ispis);
$smarty->assign("opcijeGradovi", $opcijeGradovi);
$smarty->assign("opcije", $opcije);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("gradovi.tpl");



