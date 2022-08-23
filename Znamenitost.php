<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$title = $_GET["znamenitost"];
$grad = $_GET["grad"];
if($korisnik!==null){
    
    ProvjeraIstekaSesije();
    
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Znamenitost $title";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);



$smarty->assign("grad",$grad);
$smarty->assign("title",$title);
$smarty->assign("uloga",$uloga);
$smarty->assign("korisnik",$korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("znamenitost.tpl");

