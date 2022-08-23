<?php

include_once "baza.class.php";

class Konfiguracija {
   
    public function DohvatiBrojStranicenje(){
        
        $brojRedakaStranicenje = 0;
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT broj_redaka_stranicenje FROM konfiguracija;";
        $rezultat = $baza->selectDB($upit);
        
        while($red= mysqli_fetch_array($rezultat)){
            
            $brojRedakaStranicenje = $red["broj_redaka_stranicenje"];
        }
        
        $baza->zatvoriDB();

        return $brojRedakaStranicenje;
        
    }
    
    public function DohvatiBrojPrijava(){
        
        $brojPrijava = 0;
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT broj_neuspjesnih_prijava FROM konfiguracija;";
        $rezultat = $baza->selectDB($upit);
        
        while($red= mysqli_fetch_array($rezultat)){
            
            $brojPrijava = $red["broj_neuspjesnih_prijava"];
        }
        
        $baza->zatvoriDB();

        return $brojPrijava;
        
    }
    
    public function DohvatiTrajanjeSesije(){
        
        $trajanjeSesije = 0;
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT trajanje_sesije FROM konfiguracija;";
        $rezultat = $baza->selectDB($upit);
        
        while($red= mysqli_fetch_array($rezultat)){
            
            $trajanjeSesije = $red["trajanje_sesije"];
        }

        
        $baza->zatvoriDB();

        return $trajanjeSesije;
        
    }
    
     public function DohvatiTrajanjeLinka(){
        
        $trajanjeLinka = 0;
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT trajanje_aktivacijskog_linka FROM konfiguracija;";
        $rezultat = $baza->selectDB($upit);
        
        while($red= mysqli_fetch_array($rezultat)){
            
            $trajanjeLinka = $red["trajanje_aktivacijskog_linka"];
        }
        
        $baza->zatvoriDB();

        return $trajanjeLinka;
        
    }
    
      public function DohvatiTrajanjeUvjeta(){
        
        $trajanjeUvjeta = 0;
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT trajanje_kolacica FROM konfiguracija;";
        $rezultat = $baza->selectDB($upit);
        
        while($red= mysqli_fetch_array($rezultat)){
            
            $trajanjeUvjeta = $red["trajanje_kolacica"];
        }
        
        $baza->zatvoriDB();

        return $trajanjeUvjeta;
        
    }
    
    public function DohvatiBrojPodataka(){
        
        $brojPodataka = 0;
        
        $baza = new Baza();
        $baza->spojiDB();
        
        $upit = "SELECT broj_podataka FROM konfiguracija where konfiguracija_id = 1;";
        $rezultat = $baza->selectDB($upit);
        
        while($red= mysqli_fetch_array($rezultat)){
            
            $brojPodataka = $red["broj_podataka"];
        }
        
        $baza->zatvoriDB();

        return $brojPodataka;
        
    }
    
    
}
