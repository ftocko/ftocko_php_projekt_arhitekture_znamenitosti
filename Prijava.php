<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/Konfiguracija.class.php";
include "biblioteke/VirtualnoVrijeme.class.php";
include "biblioteke/dnevnik.class.php";

$smarty->assign("putanja", $putanja);
$smarty->display("zaglavljePrijava.tpl");

$greska = "";
error_reporting(E_ALL ^ E_NOTICE);

function ProvjeraHttps() {

    if (!isset($_SERVER["HTTPS"]) || strtolower($_SERVER["HTTPS"]) != "on") {

        $adresaSkripte = 'https://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

        header("Location:$adresaSkripte");
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

$msg = "";
$config = new Konfiguracija();

function EmailAktivacija() {

    $aktiviraniKorisnik = "";
    $aktiviraniKorisnik = $_GET["korime"];
    $trajanje = $_GET["trajanje"];
    global $msg;

    $trajanje = strtotime($trajanje);
    $objekt = new VirtualnoVrijeme();
    $trenutnoVrijeme = $objekt->DohvatiVrijeme();
    $trenutnoVrijeme = strtotime($trenutnoVrijeme);

    if ($trajanje >= $trenutnoVrijeme) {

        if ($aktiviraniKorisnik !== "") {

            $baza = new Baza();
            $baza->spojiDB();

            $upit = "UPDATE korisnik SET status=1 WHERE korisnicko_ime = '$aktiviraniKorisnik';";

            $baza->updateDB($upit);

            $baza->zatvoriDB();

            $msg = "Vaš kreirani račun je uspješno aktiviran!";

            $korisnik["korisnik"] = $aktiviraniKorisnik;
            $dnevnik = new Dnevnik();
            $dnevnik->radnja = "Korisnik se uspješno registrirao.";
            $dnevnik->tip_id_radnje = 3;
            $dnevnik->Zapisi($korisnik);
        }
    } else {
        $baza = new Baza();
        $baza->spojiDB();

        $upit = "DELETE FROM korisnik WHERE korisnicko_ime = '$aktiviraniKorisnik';";

        $baza->updateDB($upit);

        $baza->zatvoriDB();
        $msg = "Aktivacijski link je istekao!";
    }
}

ProvjeraHttps();

if (isset($_GET["korime"])) {
    EmailAktivacija();
}

function DohvatiSolKorisnika($korime) {

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korime';";

    $rezultat = $baza->selectDB($upit);

    while ($red = mysqli_fetch_array($rezultat)) {
        $sol = $red["sol"];
    }

    return $sol;

    $baza->zatvoriDB();
}

function PrijaviKorisnika() {

    $dnevnik = new Dnevnik();
    $veza = new Baza();
    $veza->spojiDB();
    $username = $_POST["username"];
    $password = $_POST["lozinka"];
    $salt = DohvatiSolKorisnika($username);
    $password_sha256 = hash("sha256", $password . $salt);
    $LoggedUser = array();


    $autentificiran = false;
    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '$username'AND lozinka_sha256='$password_sha256';";

    $rezultat = $veza->selectDB($upit);

    if ($rezultat) {

        while ($red = mysqli_fetch_array($rezultat)) {

            if ($red && mysqli_num_rows($rezultat) === 1) {

                $autentificiran = true;
                $LoggedUser["uloga"] = $red["uloga_id"];
                $LoggedUser["korime"] = $red["korisnicko_ime"];
            }
        }
    }

    if ($autentificiran) {

        if (isset($_POST["zapamtiMe"])) {

            setcookie("Username", $username);
        }

        $obj = new VirtualnoVrijeme();
        $currentVrijeme = $obj->DohvatiVrijeme();
        $currentVrijeme = strtotime($currentVrijeme);

        setcookie("VrijemePrijave", $currentVrijeme);

        Sesija::kreirajKorisnika($LoggedUser["korime"], $LoggedUser["uloga"]);
        ResetirajNeuspjelePokusaje($username);
        $korisnik["korisnik"] = $username;

        $dnevnik->radnja = "Korisnik $username se prijavio u sustav.";
        $dnevnik->tip_id_radnje = 1;
        $dnevnik->Zapisi($korisnik);

        header("Location:GlavniZaslon.php");
    } else {
        global $greska;
        $greska = "Niste unijeli ispravno korisničko ime ili lozinku!";

        $dnevnik->radnja = "Korisnik $username je unio krivo korisničko ime ili lozinku.";
        $dnevnik->tip_id_radnje = 15;
        $dnevnik->Zapisi($korisnik);

        BlokirajKorisnika($username);
    }

    $veza->zatvoriDB();
}

function ProvjeriKorisnika() {

    $korime = "";

    if (isset($_COOKIE["Username"])) {

        $korime = $_COOKIE["Username"];
    }

    return $korime;
}

function BlokirajKorisnika($korracun) {

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava=broj_neuspjesnih_prijava+1 WHERE korisnicko_ime = '$korracun';";

    $rezultat = $baza->updateDB($upit);

    $baza->zatvoriDB();
}

function ResetirajNeuspjelePokusaje($korracun) {

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava=0 WHERE korisnicko_ime = '{$korracun}';";

    $rezultat = $baza->updateDB($upit);

    $baza->zatvoriDB();
}

$broj_neuspjesnih_prijava = $config->DohvatiBrojPrijava();

function BlokiranKorisnik($korime) {

    global $broj_neuspjesnih_prijava;

    $blokiran = false;

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korime' AND broj_neuspjesnih_prijava >= $broj_neuspjesnih_prijava;";
    $rezultat = $baza->selectDB($upit);

    if ($rezultat) {

        while ($red = mysqli_fetch_row($rezultat)) {
            if ($red) {
                $blokiran = true;
            }
        }
    }

    if ($blokiran === true) {

        $upitStatus = "UPDATE korisnik SET status=-1 WHERE korisnicko_ime = '$korime';";
        $rez = $baza->updateDB($upitStatus);
    } else {
        $upitStatus = "UPDATE korisnik SET status=1 WHERE korisnicko_ime = '$korime';";
        $rez = $baza->updateDB($upitStatus);
    }

    $baza->zatvoriDB();
    return $blokiran;
}

if (isset($_POST["submit"])) {

    $korisnickoIme = $_POST["username"];
    $blokiran = BlokiranKorisnik($korisnickoIme);

    if ($blokiran) {
        $greska = "Vaš korisnički račun je blokiran, zbog $broj_neuspjesnih_prijava uzastopna neuspješna pokušaja prijave!";

        $korisnik["korisnik"] = $korisnickoIme;
        $dnevnik = new Dnevnik();
        $dnevnik->radnja = "Neuspješna prijava.";
        $dnevnik->tip_id_radnje = 4;
        $dnevnik->Zapisi($korisnik);
    } else {
        PrijaviKorisnika();
    }
}

$korisnicko_ime = ProvjeriKorisnika();

$smarty->assign("msg", $msg);
$smarty->assign("korisnicko_ime", $korisnicko_ime);
$smarty->assign("greska", $greska);
$smarty->display("sadrzajPrijava.tpl");
$smarty->display("podnozjePrijava.tpl");







