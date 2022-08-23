<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";

error_reporting(E_ALL ^ E_NOTICE);

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$opcije = "";

if ($uloga === "2" || $uloga === "3" || $uloga === null) {

    header("Location:GlavniZaslon.php");
}

function FunkcijaStranicenjeKorisnikRadnja($user,$radnja){
    
    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    
    if($user=="null"){
        $sqlUpit = "SELECT d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and t.naziv_radnje = '$radnja' and k.korisnicko_ime is null;";
    }
    
    else{
        $sqlUpit = "SELECT d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and t.naziv_radnje = '$radnja' and k.korisnicko_ime = '$user';";
    }

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
    
}

function FunkcijaStranicenjeKorisnik($user) {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    
    if($user=="null"){
        $sqlUpit = "select d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and k.korisnicko_ime is null;";
    }
    
    else{
        $sqlUpit = "select d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and k.korisnicko_ime = '$user';";
    }

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeSve() {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpit = "select d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeSveRadnja($radnja) {

    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpit = "SELECT d.dnevnik_id, k.korisnicko_ime, t.naziv_radnje, d.datum_vrijeme, d.radnja from dnevnik d, korisnik k, tip t where k.korisnik_id = d.korisnik_id and t.tip_id = d.tip_id and t.naziv_radnje = '$radnja';";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();

    $baza->zatvoriDB();
}

if (isset($_POST["submitKorisnik"])) {

    $user = $_POST["korisnik"];
    FunkcijaStranicenjeKorisnik($user);
}

if(isset($_POST["submitRadnja"])){
    
    $radnja = $_POST["radnja"];
    FunkcijaStranicenjeSveRadnja($radnja);
}

if (isset($_POST["submitSve"])) {
    
    FunkcijaStranicenjeSve();
    
}

if(isset($_POST["submitKorRadnja"])){
    
    $userName = $_POST["korisnik"];
    $tipRadnje = $_POST["radnja"];
    FunkcijaStranicenjeKorisnikRadnja($userName,$tipRadnje);
}

if (!isset($_POST["submitKorisnik"])&&!isset($_POST["submitRadnja"])&&!isset($_POST["submitKorRadnja"])) {

    FunkcijaStranicenjeSve();
}

$smarty->assign("userName",$userName);
$smarty->assign("tipRadnje",$tipRadnje);
$smarty->assign("radnja",$radnja);
$smarty->assign("uloga", $uloga);
$smarty->assign("opcije", $opcije);
$smarty->assign("putanja", $putanja);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("user", $user);
$smarty->display("dnevnikRada.tpl");

