<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);

include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "biblioteke/VirtualnoVrijeme.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];

if ($uloga === "2" || $uloga === "3" || $uloga === null) {

    header("Location:GlavniZaslon.php");
}


$dnevnik = new Dnevnik();
$dnevnik->radnja = "Upravljanje konfiguracijom";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if (isset($_POST["submitPostavi"])) {

    $nacin = $_POST["nacinSpremanja"];
    $url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=$nacin";

    if (!($fp = fopen($url, 'r'))) {
        echo "Problem: nije moguće otvoriti url: " . $url;
        exit;
    }

    $string = fread($fp, 10000);
    $json = json_decode($string, false);
    $sati = $json->WebDiP->vrijeme->pomak->brojSati;
    $sati = (is_numeric($sati)) ? $sati : 0;
    fclose($fp);

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "UPDATE virtualno_vrijeme SET vrijeme = $sati WHERE vrijeme_id = 1;";

    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik->radnja = "Korisnik je promijenio virtualno vrijeme sustava.";
    $dnevnik->tip_id_radnje = 16;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["submitStranicenje"])) {

    $baza = new Baza();
    $baza->spojiDB();
    $broj_redaka_stranicenje = $_POST["stranicenje"];
    settype($broj_redaka_stranicenje, "integer");

    $upit = "UPDATE konfiguracija SET broj_redaka_stranicenje = $broj_redaka_stranicenje WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik->radnja = "Korisnik je postavio broj redaka za straničenje na $broj_redaka_stranicenje.";
    $dnevnik->tip_id_radnje = 18;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["submitBrojPrijava"])) {

    $baza = new Baza();
    $baza->spojiDB();
    $broj_neuspjesnih_prijava = $_POST["brojPrijava"];
    settype($broj_neuspjesnih_prijava, "integer");

    $upit = "UPDATE konfiguracija SET broj_neuspjesnih_prijava = $broj_neuspjesnih_prijava WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik->radnja = "Korisnik je postavio broj neuspješnih prijava na $broj_neuspjesnih_prijava.";
    $dnevnik->tip_id_radnje = 20;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["submitSesija"])) {

    $baza = new Baza();
    $baza->spojiDB();
    $trajanjeSesije = $_POST["sesija"];
    settype($trajanjeSesije, "integer");

    $upit = "UPDATE konfiguracija SET trajanje_sesije = $trajanjeSesije WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik->radnja = "Korisnik je postavio trajanje sesije na $trajanjeSesije sekundi.";
    $dnevnik->tip_id_radnje = 17;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["submitLink"])) {

    $baza = new Baza();
    $baza->spojiDB();
    $trajanjeLinka = $_POST["link"];
    settype($trajanjeLinka, "integer");

    $upit = "UPDATE konfiguracija SET trajanje_aktivacijskog_linka = $trajanjeLinka WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik->radnja = "Korisnik je postavio trajanje aktivacijskog linka na $trajanjeLinka dana.";
    $dnevnik->tip_id_radnje = 21;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["submitUvjeti"])) {

    $baza = new Baza();
    $baza->spojiDB();
    $trajanjeUvjeta = $_POST["uvjeti"];
    settype($trajanjeUvjeta, "integer");

    $upit = "UPDATE konfiguracija SET trajanje_kolacica = $trajanjeUvjeta WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);

    $baza->zatvoriDB();

    $dnevnik->radnja = "Korisnik je postavio trajanje kolačića za uvjete korištenja na $trajanjeUvjeta dana.";
    $dnevnik->tip_id_radnje = 19;
    $dnevnik->Zapisi($korisnik);
}

if (isset($_POST["resetiranjeKolacica"])) {

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "UPDATE konfiguracija SET resetirani_uvjeti = 1 WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);


    $baza->zatvoriDB();
    
    $dnevnik->radnja = "Korisnik je resetirao kolačiće za uvjete korištenja.";
    $dnevnik->tip_id_radnje = 23;
    $dnevnik->Zapisi($korisnik);
    
}


$virtualTime = new VirtualnoVrijeme();
$vrijeme = $virtualTime->DohvatiVrijeme();

$smarty->assign("vrijeme", $vrijeme);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("upravljanjeKonfiguracijom.tpl");

