<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$korime = $korisnik;
$uloga = $korisnik["uloga"];

ProvjeraIstekaSesije();

if ($korisnik == null) {
    header("Location:index.php");
}

if ($uloga === "2" || $uloga === "3") {

    header("Location:Gradovi.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Dodjela moderatora";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if (isset($_GET["username"]) && isset($_GET["town"])) {

    $username = $_GET["username"];
    $town = $_GET["town"];

    $korisnikId = DohvatiIdKorisnika($username);
    $gradId = DohvatiIdGrada($town);


    $baza = new Baza();
    $baza->spojiDB();

    $upitDelete = "DELETE FROM upravljanje_gradom WHERE moderator_id = $korisnikId AND grad_id = $gradId;";

    $baza->deleteDB($upitDelete);

    $baza->zatvoriDB();
    $poruka = "Uspješno ste oduzeli moderatora $username gradu $town!";
}

if (isset($_POST["submit"])) {

    $korisnik = $_POST["selectKorisnici"];
    $grad = $_POST["selectGradovi"];

    $korisnikId = DohvatiIdKorisnika($korisnik);
    $gradId = DohvatiIdGrada($grad);
    $postoji = ProvjeraPostojanjeUpravljanja($korisnikId, $gradId);

    if ($postoji === false) {

        $baza = new Baza();
        $baza->spojiDB();

        $upitInsert = "INSERT INTO upravljanje_gradom(moderator_id,grad_id) VALUES ($korisnikId,$gradId);";

        $baza->InsertDB($upitInsert);

        if ($korisnikId != 1) {

            $upitUpdate = "UPDATE korisnik SET uloga_id = 2 WHERE korisnik_id = $korisnikId;";
            $baza->updateDB($upitUpdate);
        }

        $baza->zatvoriDB();
        $poruka = "Uspješno ste dodijelili moderatora $korisnik gradu $grad!";

        $dnevnik->radnja = "Korisnik je dodao novog moderatora $korisnik gradu $grad!.";
        $dnevnik->tip_id_radnje = 9;
        $dnevnik->Zapisi($korime);
    } else {
        $poruka = "Korisnik $korisnik već upravlja gradom $grad!";
    }
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

function DohvatiIdGrada($grad) {

    $gradId;
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT grad_id FROM grad WHERE naziv_grada = '$grad';";
    $rezultat = $baza->selectDB($upit);

    while ($red = mysqli_fetch_array($rezultat)) {

        $gradId = $red["grad_id"];
    }

    $baza->zatvoriDB();
    return $gradId;
}

function ProvjeraPostojanjeUpravljanja($korisnikId, $gradId) {

    $postoji = false;
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT * FROM upravljanje_gradom WHERE moderator_id = $korisnikId and grad_id = $gradId;";
    $rezultat = $baza->selectDB($upit);

    $brojSlogova = mysqli_num_rows($rezultat);

    if ($brojSlogova > 0) {

        $postoji = true;
    }

    $baza->zatvoriDB();
    return $postoji;
}

$smarty->assign("poruka", $poruka);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("dodjelaModeratora.tpl");



