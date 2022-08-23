<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/dnevnik.class.php";

$smarty->display("zaglavljePovratLozinke.tpl");

function GenerirajNasumicnuLozinku($duljina)
{
    $generiranaLozinka = substr(sha1(rand()), 0, $duljina);
    return $generiranaLozinka;
}

function DinamickaSol() {

    $tekst = md5(uniqid(rand(), true));
    $sol = substr($tekst, 0, 6);
    return $sol;
}

function PromijeniLozinku($userName, $generiranaLozinka) {

    $veza = new Baza();
    $veza->spojiDB();

    $salt = DinamickaSol();
    $lozinka_sha256 = hash("sha256", $generiranaLozinka . $salt);

    $upit = "UPDATE korisnik SET lozinka = '{$generiranaLozinka}', sol='{$salt}', lozinka_sha256 = '{$lozinka_sha256}' WHERE korisnicko_ime = '{$userName}';";

    $veza->updateDB($upit);

    $veza->zatvoriDB();
}

function GenerirajLozinku($korIme,$email) {

    $generiranaLozinka = GenerirajNasumicnuLozinku(8);
    $primatelj = $email;
    $naslov = "Nova lozinka";
    $poruka = "Vaša nova lozinka:$generiranaLozinka";

    $uspjesno = mail($primatelj, $naslov, $poruka);

    if ($uspjesno) {

        PromijeniLozinku($korIme, $generiranaLozinka);
        
        $korisnik["korisnik"] = $korIme;
        $dnevnik = new Dnevnik();
        $dnevnik->radnja = "Korisnik je uputio zahtjev za promijenu lozinke.";
        $dnevnik->tip_id_radnje = 2;
        $dnevnik->Zapisi($korisnik);

        header("Location:Prijava.php");
    }
}

if (isset($_POST["submit"]) && isset($_POST["korime"])) {

    $korime = $_POST["korime"];
    $email = $_POST["email"];
    GenerirajLozinku($korime,$email);
       
}

$smarty->display("sadrzajPovratLozinke.tpl");






