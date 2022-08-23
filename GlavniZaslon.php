<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "IstekSesije.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
if($korisnik!==null){
    
    ProvjeraIstekaSesije();
    
}


$smarty->assign("uloga",$uloga);
$smarty->assign("korisnik",$korisnik);
$smarty->display("glavniZaslon.tpl");
