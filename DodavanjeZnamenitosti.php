<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include_once "biblioteke/VirtualnoVrijeme.class.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];

ProvjeraIstekaSesije();

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Dodavanje znamenitosti";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if ($korisnik == null || $uloga === "3") {
    header("Location:Gradovi.php");
}

if (isset($_GET["id"])) {

    $id = $_GET["id"];
    $korime = $korisnik["korisnik"];
}

function ProvjeraPostojanjaZnamenitosti($znam) {

    $znamPostoji = false;
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT naziv_znamenitosti FROM znamenitost WHERE naziv_znamenitosti = '$znam';";
    $rezultat = $baza->selectDB($upit);

    if (mysqli_num_rows($rezultat) > 0) {
        $znamPostoji = true;
    }

    $baza->zatvoriDB();
    return $znamPostoji;
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

function OdbijZahtjev($zahtjevid){
    
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "update zahtjev set status = 'odbijeno' where zahtjev_id = $zahtjevid;";
    $rezultat = $baza->updateDB($upit);

    $baza->zatvoriDB();
    
}


$msg;

function DodajNovuZnamenitost() {

    global $korisnik;
    global $msg;

    $zahtjev_id = "";
    $moderator = "";
    $predlozio = "";
    $nazivZnam = "";
    $opisZnam = "";
    $godinaZnam = "";

    $zahtjev_id = $_POST["zahtjev"];
    $moderator = $_POST["moderator"];
    $moderator_id = DohvatiIdKorisnika($moderator);
    $predlozio = $_POST["predlozio"];
    $nazivZnam = $_POST["nazivZnam"];
    $opisZnam = $_POST["opisZnam"];
    $godinaZnam = $_POST["godinaZnam"];
    $objekt = new VirtualnoVrijeme();
    $datumDodavanja = $objekt->DohvatiVrijeme();

    $znamPostoji = ProvjeraPostojanjaZnamenitosti($nazivZnam);
    if ($znamPostoji == true) {
        
        $msg = "Znamenitost $nazivZnam već postoji!";
        OdbijZahtjev($zahtjev_id);
        
    } else {

        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "INSERT INTO znamenitost(zahtjev_id, moderator_id, predlozio, naziv_znamenitosti, godina, datum_i_vrijeme_dodavanja, opis) VALUES ($zahtjev_id,$moderator_id,'$predlozio','$nazivZnam',$godinaZnam,'$datumDodavanja','$opisZnam');";

        $baza->InsertDB($upit);

        $baza->zatvoriDB();

        $dnevnik = new dnevnik();
        $dnevnik->radnja = "Korisnik je dodao novu znamenitost $nazivZnam.";
        $dnevnik->tip_id_radnje = 8;
        $dnevnik->Zapisi($korisnik);
        Header("Location:Znamenitosti.php");
    }
}

if (isset($_POST["submit"])) {

    DodajNovuZnamenitost();
}


$smarty->assign("msg",$msg);
$smarty->assign("id", $id);
$smarty->assign("uloga", $uloga);
$smarty->assign("korime", $korime);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("dodavanjeZnamenitosti.tpl");










