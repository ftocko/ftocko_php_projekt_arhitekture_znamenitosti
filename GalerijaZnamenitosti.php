<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje_galerije.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$opcije = "";

ProvjeraIstekaSesije();
    
if($korisnik==null){
    header("Location:index.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Galerija znamenitosti";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if(isset($_POST["submit"])){
    
    $broj = $_POST["broj"];
    PostaviBrojPodataka($broj);
    
}

if(isset($_POST["submitGodina"])){
    
    $godina = $_POST["godina"];
    FunkcijaStranicenjeMaterijalaGodina($godina);
    
}

if(!isset($_POST["submitGodina"])){
    
    FunkcijaStranicenjeMaterijala();
    
}

if(isset($_POST["submitSve"])){
    
    FunkcijaStranicenjeMaterijala();
}

function PostaviBrojPodataka($broj){
    
    $baza = new Baza();
    $baza->spojiDB();
    
    $upit = "UPDATE konfiguracija SET broj_podataka = $broj WHERE konfiguracija_id = 1;";
    $baza->updateDB($upit);
    $baza->zatvoriDB();
    
}

function FunkcijaStranicenjeMaterijala(){
    
global $opcije;
$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "SELECT * from materijal;";
    
$objekt = new stranicenjeGalerija();

$rezultat = $baza->selectDB($sqlUpit);
$num_rows = mysqli_num_rows($rezultat);
$objekt->SetBrojStranica($num_rows);

$opcije = $objekt->GenerirajOpcije();

$baza->zatvoriDB();

}

function FunkcijaStranicenjeMaterijalaGodina($godina){
    
global $opcije;
$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "select m.naziv_materijala, m.tip_materijal_id, m.putanja from materijal m, znamenitost z where z.znamenitost_id = m.znamenitost_id and z.godina = $godina;";
    
$objekt = new stranicenjeGalerija();

$rezultat = $baza->selectDB($sqlUpit);
$num_rows = mysqli_num_rows($rezultat);
$objekt->SetBrojStranica($num_rows);

$opcije = $objekt->GenerirajOpcije();

$baza->zatvoriDB();

}


$smarty->assign("godina",$godina);
$smarty->assign("opcije",$opcije);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("galerijaZnamenitosti.tpl");







