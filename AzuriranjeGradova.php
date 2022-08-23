<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$grad = $_GET["grad"];

if($korisnik!==null){
    
    ProvjeraIstekaSesije();
    
}

if($korisnik==null){
    header("Location:index.php");
}

if($uloga==="2"||$uloga==="3"){
    
    header("Location:Gradovi.php");
}

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Ažuriranje gradova";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if(isset($_POST["submit"])){
    
    $baza = new Baza();
    $baza->spojiDB();
    
    $nazivGrada = "";
    $nazivZupanije = "";
    $gradonacelnik = "";
    
    $nazivGrada = $_POST["nazivGrada"];
    $nazivZupanije = $_POST["nazivZupanije"];
    $gradonacelnik = $_POST["imePreGradonacelnika"];
    
    $idGrada = PronadjiIdGrada($nazivGrada);
    
    $upit = "UPDATE grad SET naziv_grada = '$nazivGrada', naziv_zupanije = '$nazivZupanije', gradonacelnik = '$gradonacelnik' WHERE grad_id = '$idGrada';";
    
    if($nazivGrada===""||$nazivZupanije===""||$gradonacelnik===""){
        
        $poruka = "Niste unijeli sve podatke za ažuriranje grada!";
    }
    
    else{
        
        $rezultat = $baza->updateDB($upit);
        $poruka = "Uspješno ste ažurirali grad!";  
        
    }
    
    $baza->zatvoriDB();
    
}

function PronadjiIdGrada($nameGrad){
    
    $baza = new Baza();
    $baza->spojiDB();
    
    $upit = "SELECT grad_id FROM grad WHERE naziv_grada = '$nameGrad';";
    
    $rezultat = $baza->selectDB($upit);
    
    while($red = mysqli_fetch_array($rezultat)){
        
        $grad_id = $red["grad_id"];
    }
    
    $baza->zatvoriDB();
    
    return $grad_id;
    
}

$smarty->assign("poruka",$poruka);
$smarty->assign("grad",$grad);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja",$putanja);
$smarty->display("azuriranjeGradova.tpl");



