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
$opcije = "";
ProvjeraIstekaSesije();
$nazivGrad = "";
$nazivZnam = "";
$opisZnam = "";
$prijedlogId;

if ($korisnik == null) {
    header("Location:Gradovi.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Dodavanje zahtjeva";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

function DohvatiStatusKorisnika() {

    global $korisnik;
    $veza = new Baza();
    $veza->spojiDB();
    $korime = $korisnik["korisnik"];

    $upit = "SELECT status_zahtjev from korisnik where korisnicko_ime = '$korime';";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $status = $red["status_zahtjev"];
    }

    $veza->zatvoriDB();
    return $status;
}

$status = DohvatiStatusKorisnika();

function DohvatiPrijedlogZaZahtjev($prijedlogId) {

    global $nazivGrad;
    global $nazivZnam;
    global $opisZnam;

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT g.naziv_grada, p.naziv_znamenitosti, p.opis_znamenitosti from grad g inner join prijedlog p where g.grad_id = p.grad_id and p.prijedlog_id = $prijedlogId;";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $nazivGrad = $red["naziv_grada"];
        $nazivZnam = $red["naziv_znamenitosti"];
        $opisZnam = $red["opis_znamenitosti"];
    }

    $veza->zatvoriDB();
}

if (isset($_GET["prijedlog"])) {

    $prijedlogId = $_GET["prijedlog"];
    DohvatiPrijedlogZaZahtjev($prijedlogId);

    $link = new Baza();
    $link->spojiDB();

    $query = "UPDATE pohrana SET trenutni_prijedlog_id = $prijedlogId WHERE pohrana_id = 1;";

    $link->updateDB($query);

    $link->zatvoriDB();
}

function FunkcijaStranicenjeZahtjevi() {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    $sqlUpit = "SELECT * FROM zahtjev;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function DohvatiIdGrada($grad) {

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT grad_id from grad where naziv_grada = '$grad';";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $grad_id = $red["grad_id"];
    }

    $veza->zatvoriDB();
    return $grad_id;
}

function DohvatiIdKorisnika($korisnik) {

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT korisnik_id from korisnik where korisnicko_ime = '$korisnik';";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $korisnikId = $red["korisnik_id"];
    }

    $veza->zatvoriDB();
    return $korisnikId;
}

function DohvatiIdPrijedloga() {

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT trenutni_prijedlog_id from pohrana;";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $prijedlogId = $red["trenutni_prijedlog_id"];
    }

    $veza->zatvoriDB();
    return $prijedlogId;
}

$poruka = "";

function DodajNoviZahtjev() {

    global $korisnik;
    global $poruka;
    $grad = "";
    $nazivZnamenitosti = "";
    $godinaZnamenitosti = "";
    $opisZnamenitosti = "";

    $grad = $_POST["grad"];
    $nazivZnamenitosti = $_POST["nazivZnamenitosti"];
    $godinaZnamenitosti = $_POST["godinaZnamenitosti"];
    $opisZnamenitosti = $_POST["opisZnamenitosti"];
    $korime = $korisnik["korisnik"];

    $gradId = DohvatiIdGrada($grad);
    settype($godinaZnamenitosti, "integer");
    $korisnikId = DohvatiIdKorisnika($korime);
    $prijedlogId = DohvatiIdPrijedloga();

    $baza = new Baza();
    $baza->spojiDB();

    if ($prijedlogId == 0) {

        $upit = "INSERT INTO zahtjev(registrirani_korisnik_id,grad_id,naziv_znamenitosti,opis_znamenitosti,godina_znamenitosti,status) VALUES ($korisnikId,$gradId,'$nazivZnamenitosti','$opisZnamenitosti',$godinaZnamenitosti,'obrada');";
    } else {
        $upit = "INSERT INTO zahtjev(registrirani_korisnik_id,grad_id,naziv_znamenitosti,opis_znamenitosti,godina_znamenitosti,status,prijedlog_id) VALUES ($korisnikId,$gradId,'$nazivZnamenitosti','$opisZnamenitosti',$godinaZnamenitosti,'obrada',$prijedlogId);";
    }

    $baza->InsertDB($upit);

    $dnevnik = new dnevnik();
    $dnevnik->radnja = "Korisnik je dodao novi zahtjev za znamenitost $nazivZnamenitosti.";
    $dnevnik->tip_id_radnje = 7;
    $dnevnik->Zapisi($korisnik);

    $baza->zatvoriDB();

    $poruka = "<script> alert(Uspješno ste dodali novi zahtjev za znamenitost!); </script>";
}

FunkcijaStranicenjeZahtjevi();

if (isset($_POST["submit"])) {

    DodajNoviZahtjev();

    header("Location:DodavanjeZahtjeva.php");
}

function ResetPodaci() {

    $link = new Baza();
    $link->spojiDB();

    $query = "UPDATE pohrana SET trenutni_prijedlog_id = 0 WHERE pohrana_id = 1;";

    $link->updateDB($query);

    $link->zatvoriDB();
}

if (!isset($_GET["prijedlog"])) {

    ResetPodaci();
}

$smarty->assign("status", $status);
$smarty->assign("nazivGrad", $nazivGrad);
$smarty->assign("nazivZnam", $nazivZnam);
$smarty->assign("opisZnam", $opisZnam);
$smarty->assign("opcije", $opcije);
$smarty->assign("poruka", $poruka);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("dodavanjeZahtjeva.tpl");


