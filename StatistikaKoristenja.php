<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";

error_reporting(E_ALL ^ E_NOTICE);

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
ProvjeraIstekaSesije();
$opcije = "";

if ($uloga === "2" || $uloga === "3" || $uloga === null) {

    header("Location:GlavniZaslon.php");
}

function FunkcijaStranicenjeStatistikeKorisnik($user) {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();

    if ($user == "null") {
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime is null group by stranica;";
    } else {
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime = '$user' group by stranica;";
    }


    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeStatistikeKorisnikVrijeme($userName, $timeOd, $timeDo) {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    
    if($userName=="null"){
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime is null and (dnevnik.datum_vrijeme between '$timeOd' and '$timeDo') group by stranica;";
    }
    
    else{
        $sqlUpit = "SELECT dnevnik.radnja as stranica, count(dnevnik.korisnik_id) as broj_pristupa from dnevnik, korisnik where dnevnik.tip_id = 5 and korisnik.korisnik_id = dnevnik.korisnik_id and korisnik.korisnicko_ime = '$userName' and (dnevnik.datum_vrijeme between '$timeOd' and '$timeDo') group by stranica;";
    }
    

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeStatistikeVrijeme($vrijemeOd, $vrijemeDo) {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    $sqlUpit = "select radnja as stranica, count(korisnik_id) as broj_pristupa from dnevnik where tip_id = 5 and datum_vrijeme between '$vrijemeOd' and '$vrijemeDo' group by stranica;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeStatistike() {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    $sqlUpit = "select radnja as stranica, count(korisnik_id) as broj_pristupa from dnevnik where tip_id = 5 group by stranica;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

if (isset($_POST["submitUser"])) {

    $user = $_POST["userStatistika"];
    FunkcijaStranicenjeStatistikeKorisnik($user);
}

if (isset($_POST["submitAll"])) {

    FunkcijaStranicenjeStatistike();
}

if (isset($_POST["submitVrijeme"])) {

    $vrijemeOd = $_POST["vrijemeOd"];
    $vrijemeDo = $_POST["vrijemeDo"];
    FunkcijaStranicenjeStatistikeVrijeme($vrijemeOd, $vrijemeDo);
}

if (isset($_POST["submitVrijemeKor"])) {

    $userName = $_POST["userStatistika"];
    $timeOd = $_POST["vrijemeOd"];
    $timeDo = $_POST["vrijemeDo"];
    FunkcijaStranicenjeStatistikeKorisnikVrijeme($userName, $timeOd, $timeDo);
}

if (!isset($_POST["submitUser"]) && !isset($_POST["submitVrijeme"]) && !isset($_POST["submitVrijemeKor"])) {

    FunkcijaStranicenjeStatistike();
}

$smarty->assign("userName", $userName);
$smarty->assign("timeOd", $timeOd);
$smarty->assign("timeDo", $timeDo);
$smarty->assign("user", $user);
$smarty->assign("vrijemeOd", $vrijemeOd);
$smarty->assign("vrijemeDo", $vrijemeDo);
$smarty->assign("opcije", $opcije);
$smarty->assign("putanja", $putanja);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->display("statistikaKoristenja.tpl");


