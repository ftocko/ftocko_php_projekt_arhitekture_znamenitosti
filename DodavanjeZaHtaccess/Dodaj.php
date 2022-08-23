<?php

include_once "../biblioteke/baza.class.php";

$dat = "../privatno/users.txt";

function UpisiKorisnike(){
    
    global $dat;
    
    $baza = new Baza();
    $baza->spojiDB();
    
    $upit = "select korisnicko_ime, lozinka from korisnik where korisnicko_ime is not null;";
    
    $rezultat = $baza->selectDB($upit);
    
    while($red=mysqli_fetch_array($rezultat)){
        
        $korime = $red["korisnicko_ime"];
        $lozinka = $red["lozinka"];
        
        $rez = shell_exec("/usr/bin/htpasswd -b $dat $korime $lozinka");
        
    }
    
    
    $baza->zatvoriDB();
    
}





