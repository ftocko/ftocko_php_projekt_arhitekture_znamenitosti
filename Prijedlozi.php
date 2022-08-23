<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";


$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$opcije = "";

if($korisnik==null){
    header("Location:Gradovi.php");
}

ProvjeraIstekaSesije();

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Prijedlozi";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

function FunkcijaStranicenjePrijedlozi(){
    
global $opcije;
$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "select p.prijedlog_id, g.naziv_grada, p.naziv_znamenitosti, p.opis_znamenitosti, p.nadimak, p.ime_prezime from grad g inner join prijedlog p where g.grad_id = p.grad_id order by 1;";
    
$objekt = new stranicenje();

$rezultat = $baza->selectDB($sqlUpit);
$num_rows = mysqli_num_rows($rezultat);
$objekt->SetBrojStranica($num_rows);

$opcije = $objekt->GenerirajOpcije();

$baza->zatvoriDB();

}

FunkcijaStranicenjePrijedlozi();

$smarty->assign("opcije",$opcije);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("prijedlozi.tpl");





