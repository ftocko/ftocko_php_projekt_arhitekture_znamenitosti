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


$smarty->assign("putanja",$putanja);
$smarty->display("zaglavlje.tpl");
$smarty->display("index.tpl");
$smarty->display("podnozje.tpl");


        

       
