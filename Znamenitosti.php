<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL^E_NOTICE^E_WARNING);
$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$korime = $korisnik["korisnik"];
$opcije = "";
$sendUpit = "";

ProvjeraIstekaSesije();

if ($korisnik == null||$uloga==="3") {
    header("Location:Gradovi.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Znamenitosti";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);


function DohvatiSqlGradovi($gradovi){
    
    $sql = "";
    
    for($i=0;$i<count($gradovi);$i++){
        
        if($i===count($gradovi)-1){
            $sql.="z.grad_id = {$gradovi[$i]}";
        }
        else{
            $sql.="z.grad_id = {$gradovi[$i]} or ";
        }
    
    }
    
    return $sql;
    
}

function DohvatiGradoveKorisnika(){
    
    $gradovi = array();
    $veza = new Baza();
    $veza->spojiDB();
    
    $korisnikId = DohvatiIdKorisnika();

    $upit = "select grad_id from upravljanje_gradom where moderator_id = $korisnikId;";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $gradovi[] = $red["grad_id"];
        
    }

    $veza->zatvoriDB();
    return $gradovi;
    
}

function DohvatiZahtjeveKorisnika(){
    
    $zahtjevi = array();
    $veza = new Baza();
    $veza->spojiDB();
    
    $gradovi = DohvatiGradoveKorisnika();
    $sql = DohvatiSqlGradovi($gradovi);

    $upit = "select z.zahtjev_id from zahtjev z where $sql;";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $zahtjevi[] = $red["zahtjev_id"];
        
    }

    $veza->zatvoriDB();
    return $zahtjevi;
    
}

function DohvatiSqlZahtjevi($zahtjevi){
    
     $sql = "";
    
    for($i=0;$i<count($zahtjevi);$i++){
        
        if($i===count($zahtjevi)-1){
            $sql.="z.zahtjev_id = {$zahtjevi[$i]}";
        }
        else{
            $sql.="z.zahtjev_id = {$zahtjevi[$i]} or ";
        }
    
    }
    
    return $sql;
    
}

function DohvatiIdKorisnika() {

    global $korime;
    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT korisnik_id from korisnik where korisnicko_ime = '$korime';";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $korisnikId = $red["korisnik_id"];
    }

    $veza->zatvoriDB();
    return $korisnikId;
}


function FunkcijaStranicenjeZahtjevi(){
    
    global $sendUpit;
    global $opcije;
    $baza = new Baza();
    $baza->spojiDB();
    $zahtjevi = DohvatiZahtjeveKorisnika();
    $sql = DohvatiSqlZahtjevi($zahtjevi);
    
    $sqlUpit = "select distinct z.znamenitost_id,z.zahtjev_id,k.korisnicko_ime,z.predlozio,z.naziv_znamenitosti,z.godina,z.datum_i_vrijeme_dodavanja,z.opis from korisnik k, znamenitost z where k.korisnik_id = z.moderator_id and ($sql) order by 1;";
    $sendUpit = "select distinct z.znamenitost_id,z.zahtjev_id,k.korisnicko_ime,z.predlozio,z.naziv_znamenitosti,z.godina,z.datum_i_vrijeme_dodavanja,z.opis from korisnik k, znamenitost z where k.korisnik_id = z.moderator_id and ($sql) order by 1 ";
         
    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije= $objekt->GenerirajOpcije();
    
    $baza->zatvoriDB();
}

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    $korime = $korisnik["korisnik"];
    
}

FunkcijaStranicenjeZahtjevi();

$smarty->assign("id",$id);
$smarty->assign("sendUpit",$sendUpit);
$smarty->assign("opcije", $opcije);
$smarty->assign("uloga", $uloga);
$smarty->assign("korime",$korime);
$smarty->assign("korisnik", $korisnik);
$smarty->display("znamenitosti.tpl");








