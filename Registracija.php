<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/VirtualnoVrijeme.class.php";
include "biblioteke/Konfiguracija.class.php";

$config = new Konfiguracija();
$trajanjeKolacica = $config->DohvatiTrajanjeUvjeta();

$smarty->assign("trajanjeKolacica", $trajanjeKolacica);

$obrisi = "";
$resetirani = "";


if(isset($_GET["unreset"])){
    
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "UPDATE konfiguracija SET resetirani_uvjeti = 0 WHERE konfiguracija_id = 1;";

    $baza->updateDB($upit);
    
    $baza->zatvoriDB();
    
}

function ProvjeriResetiranjeKolacica(){
    
    global $resetirani;
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT resetirani_uvjeti FROM konfiguracija WHERE konfiguracija_id = 1;";

    $rezultat = $baza->selectDB($upit);
    
    while($red=mysqli_fetch_array($rezultat)){
        
        $resetirani = $red["resetirani_uvjeti"];
    }
   
    $baza->zatvoriDB();
    
    
}

function ProvjeriIstekKolacica(){
    
    global $obrisi;
    $obrisi = "false";
    
    $object = new VirtualnoVrijeme();
    $currentTime = $object->DohvatiVrijeme();
    $currentTime = strtotime($currentTime);
    
    $configuration = new Konfiguracija();
    $trajanjeDana = $configuration->DohvatiTrajanjeUvjeta();
    $trajanjeSekunde = $trajanjeDana*24*60*60;
    
    $vrijemePrihvacanja = $_COOKIE["VrijemePrihvacanja"];
    
    if(($currentTime-$vrijemePrihvacanja) > $trajanjeSekunde){
        
        $obrisi = "true";
    }
    
}

ProvjeriIstekKolacica();
ProvjeriResetiranjeKolacica();

$smarty->assign("resetirani",$resetirani);
$smarty->assign("obrisi",$obrisi);
$smarty->assign("putanja",$putanja);

$smarty->display("zaglavljeRegistracija.tpl");

$greska = "";
$message = "";

error_reporting(E_ALL ^ E_NOTICE);

function VerificirajCaptcha() {

    if (!empty($_POST['g-recaptcha-response'])) {
        $secret = '6LelrxcbAAAAAFMQhTmoPIZV7mQVCb6jDfcHoqOD';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) {
            return true;
        } else {
            return false;
        }
    }
}

function DinamickaSol() {

    $tekst = md5(uniqid(rand(), true));
    $sol = substr($tekst, 0, 6);
    return $sol;
}

function ProvjeraMaila($korEmail) {

    $mailPostoji = false;

    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpit = "SELECT email FROM korisnik;";
    $rezultat = $baza->selectDB($sqlUpit);

    while ($red = mysqli_fetch_array($rezultat)) {

        if ($red["email"] === $korEmail) {

            $mailPostoji = true;
            break;
        }
    }

    return $mailPostoji;
}

function ProvjeraKorime($korisnickoIme){
    
    $korimePostoji = false;

    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpit = "SELECT korisnicko_ime FROM korisnik;";
    $rezultat = $baza->selectDB($sqlUpit);

    while ($red = mysqli_fetch_array($rezultat)) {

        if ($red["korisnicko_ime"] === $korisnickoIme) {

            $korimePostoji = true;
            break;
        }
    }

    return $korimePostoji;
    
}



if (isset($_POST["submitRegister"])) {

    $korisnickoIme = "";
    $lozinka = "";
    $ponovljenaLozinka = "";
    $ime = "";
    $prezime = "";

    $korisnickoIme = $_POST["korime"];
    $lozinka = $_POST["lozinka"];
    $ponovljenaLozinka = $_POST["ponovljenaLozinka"];
    $email = $_POST["email"];
    $korisnikPostoji = $_COOKIE["KorimePostoji"];
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $sadrzi = false;
    $captcha = VerificirajCaptcha();

    $postoji = ProvjeraMaila($email);
    $korimePostoji = ProvjeraKorime($korisnickoIme);

    if ($postoji === true) {

        $greska .= "Već postoji registrirani korisnik s tom E-mail adresom!";
    }
    
    if($korimePostoji===true){
        $greska .= "Već postoji registrirani korisnik s tim korisničkim imenom!";
    }

    for ($i = 0; $i < strlen($korisnickoIme); $i++) {

        if (is_numeric($korisnickoIme[$i])) {
            $sadrzi = true;
        }
    }

    if ($sadrzi === true) {

        $greska .= "Korisničo ime sadrži brojke!";
    }

    if ($ime[0] !== strtoupper($ime[0])|| is_numeric($ime[0])) {

        $greska .= "Početno slovo Vašeg imena nije veliko slovo!";
    }

    if ($prezime[0] !== strtoupper($prezime[0])|| is_numeric($ime[0])) {

        $greska .= "Početno slovo Vašeg prezimena nije veliko slovo!";
    }

    if ($ime === "" || $prezime === "") {

        $greska .= "Niste unijeli svoje ime ili prezime!";
    }

    if (strlen($lozinka) < 8 || strlen($lozinka) > 10) {

        $greska .= "Lozinka mora imati 8-10 znakova!" . " ";
    }

    if ($captcha != true) {

        $greska .= "Neuspješna provjera reCAPTCHA!" . " ";
    }

    if ($greska === "") {

        $config = new Konfiguracija();
        $trajanjeLinka = $config->DohvatiTrajanjeLinka();
        
        $virtualTime = new VirtualnoVrijeme();
        $time = $virtualTime->DohvatiVrijeme();
        $time = strtotime($time);
        
        $trajanje = $time + ($trajanjeLinka * 24 * 60 * 60);
        $konacnoTrajanje = date("d.m.Y H:i:s", $trajanje);

        $primatelj = "ftocko@foi.hr";
        $subject = "Aktivacija računa";
        $poruka = "Aktivirajte svoj račun klikom na poveznicu https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/Prijava.php?korime=$korisnickoIme&trajanje=$konacnoTrajanje";

        Registriraj();
        $uspjesno = mail($primatelj, $subject, $poruka);

        if ($uspjesno) {

            $message = "Uspješno ste registrirani, za aktivaciju računa, posjetite vaš E-mail!";
 
            
        }
    }
}

function Registriraj() {

    $veza = new Baza();
    $veza->spojiDB();

    global $ime;
    global $prezime;
    global $korisnickoIme;
    global $lozinka;
    global $email;

    $salt = DinamickaSol();
    $lozinka_sha256 = hash("sha256", $lozinka . $salt);

    if ($ime !== "" && $prezime !== "" && isset($_COOKIE["UvjetiKoristenja"])) {

        $uvjeti = $_COOKIE["VrijemePrihvacanja"];

        $dateTimeUvjeta = date("Y-m-d H:i:s", $uvjeti);

        $datumRegistracije = "";

        $objekt = new VirtualnoVrijeme();

        $datumRegistracije = $objekt->DohvatiVrijeme();

        $upit = "INSERT INTO korisnik(ime,prezime,uloga_id,korisnicko_ime,lozinka,lozinka_sha256,email,uvjeti,status,datum_registracije,broj_neuspjesnih_prijava,sol,status_zahtjev) VALUES ('$ime','$prezime',3,'$korisnickoIme','$lozinka','$lozinka_sha256','$email','$dateTimeUvjeta',0,'$datumRegistracije',0,'$salt',1);";
    }

    if ($ime === "" && $prezime === "" && isset($_COOKIE["UvjetiKoristenja"])) {

        $uvjeti = $_COOKIE["VrijemePrihvacanja"];

        $uvjeti = strtotime($uvjeti);

        $dateTimeUvjeta = date("Y-m-d H:i:s", $uvjeti);

        $upit = "INSERT INTO korisnik(uloga_id,korisnicko_ime,lozinka,lozinka_sha256,email,uvjeti,status,datum_registracije,broj_neuspjesnih_prijava,sol,status_zahtjev) VALUES (3,'$korisnickoIme','$lozinka','$lozinka_sha256','$email','$dateTimeUvjeta',0,'$datumRegistracije',0,'$salt',1);";
    }

    $veza->InsertDB($upit);
    $veza->zatvoriDB();
}

$smarty->assign("message",$message);
$smarty->assign("greska", $greska);
$smarty->display("sadrzajRegistracija.tpl");
$smarty->display("podnozjeRegistracija.tpl");








