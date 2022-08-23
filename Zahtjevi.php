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
$opcije = "";
$opcijeZahtjevi = "";
$korime = $korisnik["korisnik"];
$sendUpit = "";
$sendUpitZahtjevi = "";
$poruka = "";

ProvjeraIstekaSesije();

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Zahtjevi";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if ($korisnik == null||$uloga==="3") {
    header("Location:Gradovi.php");
}


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

function FunkcijaStranicenjeKorisniciZahtjevi() {

    global $opcije;
    global $sendUpit;
    $baza = new Baza();
    $baza->spojiDB();
    $gradovi = DohvatiGradoveKorisnika();
    $sql = DohvatiSqlGradovi($gradovi);
    
    $sqlUpit = "select distinct k.korisnicko_ime, count(*) as broj_zahtjeva from korisnik k, zahtjev z where k.korisnik_id = z.registrirani_korisnik_id and ($sql) group by k.korisnicko_ime;";

    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcije = $objekt->GenerirajOpcije();
    
    $sendUpit =  "select distinct k.korisnicko_ime, k.status_zahtjev, count(*) as broj_zahtjeva from korisnik k, zahtjev z where k.korisnik_id = z.registrirani_korisnik_id and ($sql) group by k.korisnicko_ime ";

    $baza->zatvoriDB();
}

function FunkcijaStranicenjeZahtjevi(){
    
    global $sendUpitZahtjevi;
    global $opcijeZahtjevi;
    $baza = new Baza();
    $baza->spojiDB();
    $gradovi = DohvatiGradoveKorisnika();
    $sql = DohvatiSqlGradovi($gradovi);
    
    $sqlUpit = "select distinct z.zahtjev_id,k.korisnicko_ime,g.naziv_grada,z.naziv_znamenitosti,z.opis_znamenitosti,z.godina_znamenitosti,z.status,z.prijedlog_id from korisnik k, zahtjev z, grad g where k.korisnik_id = z.registrirani_korisnik_id and ($sql) and g.grad_id = z.grad_id order by 1;";
    $sendUpitZahtjevi = "select distinct z.zahtjev_id,k.korisnicko_ime,g.naziv_grada,z.naziv_znamenitosti,z.opis_znamenitosti,z.godina_znamenitosti,z.status,z.prijedlog_id from korisnik k, zahtjev z, grad g where k.korisnik_id = z.registrirani_korisnik_id and ($sql) and g.grad_id = z.grad_id order by 1 ";
            
    $objekt = new stranicenje();

    $rezultat = $baza->selectDB($sqlUpit);
    $num_rows = mysqli_num_rows($rezultat);
    $objekt->SetBrojStranica($num_rows);

    $opcijeZahtjevi = $objekt->GenerirajOpcije();
    
    $baza->zatvoriDB();
}

function BlokirajDeblokirajKorisnika($parametar,$korime){
    
    global $poruka;
    $veza = new Baza();
    $veza->spojiDB();
    
    if($parametar==="blokiraj"){
        
        $upit = "update korisnik set status_zahtjev = 0 WHERE korisnicko_ime = '$korime';";
        $poruka = "Uspješno ste blokirali korisnika $korime!";
        
    }
    
    else if($parametar==="deblokiraj"){
        
        $upit = "update korisnik set status_zahtjev = 1 WHERE korisnicko_ime = '$korime';";
        $poruka = "Uspješno ste deblokirali korisnika $korime!";
    }
    
    $veza->updateDB($upit);
    
    $veza->zatvoriDB();
    
}

function PotvrdiOdbijZahtjev(){
    
    $kljuc = $_GET["kljuc"];
    $zahtjev_id = $_GET["zahtjev_id"];
    
    if($kljuc==="potvrdi"){
        
        $upit = "update zahtjev set status = 'potvrdjeno' where zahtjev_id = $zahtjev_id;";
        header("Location:DodavanjeZnamenitosti.php?id=$zahtjev_id");
    }
    
    else if($kljuc==="odbij"){
        
        $upit = "update zahtjev set status = 'odbijeno' where zahtjev_id = $zahtjev_id;";
        
    }
    
    $veza = new Baza();
    $veza->spojiDB();
    
    $veza->updateDB($upit);
    
    $veza->zatvoriDB();
    
}

if(isset($_GET["param"])){
    
    $parametar = $_GET["param"];
    $korime = $_GET["korime"];
    BlokirajDeblokirajKorisnika($parametar,$korime);
    header("Location:Zahtjevi.php");
    
}

if(isset($_GET["kljuc"])){
    
    PotvrdiOdbijZahtjev();
    
}

FunkcijaStranicenjeKorisniciZahtjevi();
FunkcijaStranicenjeZahtjevi();

$smarty->assign("sendUpitZahtjevi",$sendUpitZahtjevi);
$smarty->assign("opcijeZahtjevi", $opcijeZahtjevi);
$smarty->assign("poruka",$poruka);
$smarty->assign("sendUpit",$sendUpit);
$smarty->assign("opcije", $opcije);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("zahtjevi.tpl");




