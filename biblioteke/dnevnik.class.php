<?php

include_once "baza.class.php";
include_once "VirtualnoVrijeme.class.php";

class dnevnik {

    public $korisnik_id = "";
    public $tip_id_radnje = "";
    public $radnja = "";

    public function ZapisiUDnevnik() {

        $baza = new Baza();
        $veza = $baza->spojiDB();

        $objekt = new VirtualnoVrijeme();

        $datumVrijeme = $objekt->DohvatiVrijeme();

        $korisnik = $this->korisnik_id;
        $tip = $this->tip_id_radnje;
        $radnja = $this->radnja;


        $sqlUpit = "INSERT INTO dnevnik(korisnik_id,tip_id,datum_vrijeme,radnja) VALUES ($korisnik,$tip,'$datumVrijeme','$radnja');";


        $baza->InsertDB($sqlUpit);

        $baza->zatvoriDB();
    }
    

    public function Zapisi($korisnik) {

        $korisnikId = 0;
        $korimeDnevnik = $korisnik["korisnik"];

        if ($korimeDnevnik === null) {

            $korisnikId = 22;
        } else {
            $korisnikId = $this->DohvatiIdKorisnika($korimeDnevnik);
        }
        
        $this->korisnik_id = $korisnikId;

        $this->ZapisiUDnevnik();
    }

    public function DohvatiIdKorisnika($korisnik) {

        $korisnikId;
        $baza = new Baza();
        $baza->spojiDB();

        $upit = "SELECT korisnik_id FROM korisnik WHERE korisnicko_ime = '$korisnik';";
        $rezultat = $baza->selectDB($upit);

        while ($red = mysqli_fetch_array($rezultat)) {

            $korisnikId = $red["korisnik_id"];
        }

        $baza->zatvoriDB();
        return $korisnikId;
    }

}
