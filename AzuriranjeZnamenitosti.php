<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];

ProvjeraIstekaSesije();

if ($korisnik == null) {
    header("Location:index.php");
}

if ($uloga === "3") {

    header("Location:Gradovi.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Ažuriranje znamenitosti";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

$id = $_GET["id"];

function AzurirajZnamenitost() {
    
    global $korisnik;

    $znamenitost_id = $_POST["znamenitost"];
    $predlozio = $_POST["predlozio"];
    $nazivZnam = $_POST["nazivZnam"];
    $opisZnam = $_POST["opisZnam"];
    $godinaZnam = $_POST["godinaZnam"];

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "UPDATE znamenitost SET naziv_znamenitosti = '$nazivZnam', opis = '$opisZnam', godina = $godinaZnam, predlozio = '$predlozio' WHERE znamenitost_id = $znamenitost_id;";
    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik = new Dnevnik();
    $dnevnik->radnja = "Korisnik je ažurirao znamenitost $nazivZnam.";
    $dnevnik->tip_id_radnje = 22;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["submit"])) {

    AzurirajZnamenitost();
    header("Location:Znamenitosti.php");
}


$smarty->assign("id", $id);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("azuriranjeZnamenitosti.tpl");


