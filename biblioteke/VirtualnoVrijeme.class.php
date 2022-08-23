<?php

include_once "baza.class.php";

class VirtualnoVrijeme {

    function DohvatiVrijeme() {
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT vrijeme FROM virtualno_vrijeme;";
        $rezultat = $baza->selectDB($upit);
        
        $sati = 0;
        while($red= mysqli_fetch_array($rezultat)){
            
            $sati = $red["vrijeme"];
        }
        
        $baza->zatvoriDB();
        
        settype($sati,"integer");
        
        $vrijeme_servera = time();
        $vrijeme= $vrijeme_servera + ($sati * 60 * 60);
        $vrijeme =  date("Y-m-d H:i:s",$vrijeme);

        return $vrijeme;
    }

}
