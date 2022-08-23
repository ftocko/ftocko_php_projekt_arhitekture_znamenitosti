<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/stranicenje.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL^E_NOTICE);

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];

if($korisnik!==null){
    
    ProvjeraIstekaSesije();
    
}

$grad = $_GET["grad"];
$title = $grad;
$opcije = "";

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Grad $grad";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);


function FunkcijaStranicenjeZnamenitosti(){
    
global $opcije;
global $grad;

$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "select g.naziv_grada, zn.naziv_znamenitosti from grad g inner join zahtjev z on z.grad_id = g.grad_id inner join znamenitost zn on zn.zahtjev_id = z.zahtjev_id where g.naziv_grada = '$grad';";
    
$objekt = new stranicenje();

$rezultat = $baza->selectDB($sqlUpit);
$num_rows = mysqli_num_rows($rezultat);
$objekt->SetBrojStranica($num_rows);

$opcije = $objekt->GenerirajOpcije();

$baza->zatvoriDB();

}

FunkcijaStranicenjeZnamenitosti();

$smarty->assign("opcije",$opcije);
$smarty->assign("uloga",$uloga);
$smarty->assign("korisnik",$korisnik);
$smarty->assign("title",$title);
$smarty->assign("putanja",$putanja);
$smarty->display("grad.tpl");

