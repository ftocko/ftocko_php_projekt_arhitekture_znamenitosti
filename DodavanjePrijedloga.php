<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/VirtualnoVrijeme.class.php";
include "biblioteke/Konfiguracija.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
if ($korisnik !== null) {

    ProvjeraIstekaSesije();
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Dodavanje prijedloga";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

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

$poruka = "";

function DodajNoviPrijedlog() {

    $ime_prezime = "";
    $nadimak = "";
    $grad = "";
    $naziv_znamenitosti = "";
    $opis_znamenitosti = "";
    $grad_id = "";
    $upit = "";
    global $poruka;
    global $korisnik;

    $ime_prezime = $_POST["imePrezime"];
    $nadimak = $_POST["nadimak"];
    $grad = $_POST["grad"];
    $naziv_znamenitosti = $_POST["nazivZnam"];
    $opis_znamenitosti = $_POST["opisZnam"];
    $grad_id = DohvatiIdGrada($grad);

    if (isset($_POST["nadimak"]) && !isset($_POST["imePrezime"])) {

        $upit = "INSERT into prijedlog(grad_id,naziv_znamenitosti,opis_znamenitosti,nadimak) values ($grad_id,'$naziv_znamenitosti','$opis_znamenitosti','$nadimak');";
    } else if (!isset($_POST["nadimak"]) && isset($_POST["imePrezime"])) {

        $upit = "INSERT into prijedlog(grad_id,naziv_znamenitosti,opis_znamenitosti,ime_prezime) values ($grad_id,'$naziv_znamenitosti','$opis_znamenitosti','$ime_prezime');";
    } else if (isset($_POST["nadimak"]) && isset($_POST["imePrezime"])) {

        $upit = "INSERT into prijedlog(grad_id,naziv_znamenitosti,opis_znamenitosti,nadimak, ime_prezime) values ($grad_id,'$naziv_znamenitosti','$opis_znamenitosti','$nadimak','$ime_prezime');";
    } else {

        $upit = "INSERT into prijedlog(grad_id,naziv_znamenitosti,opis_znamenitosti) values ($grad_id,'$naziv_znamenitosti','$opis_znamenitosti');";
    }
    
    $objekt = new Dnevnik();
    $objekt->radnja = "Korisnik je dodao novi prijedlog za znamenitost $naziv_znamenitosti.";
    $objekt->tip_id_radnje = 6;
    $objekt->Zapisi($korisnik);

    $veza = new Baza();
    $veza->spojiDB();

    $rezultat = $veza->InsertDB($upit);

    if ($rezultat) {

        $poruka = "Uspješno dodan novi prijedlog za znamenitost!";
    }

    $veza->zatvoriDB();
    
    
}

if (isset($_POST["submit"])) {

    DodajNoviPrijedlog();

    
}


$smarty->assign("poruka", $poruka);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("dodavanjePrijedloga.tpl");

