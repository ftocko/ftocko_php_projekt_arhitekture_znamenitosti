<?php

include_once "biblioteke/Konfiguracija.class.php";
include_once "biblioteke/VirtualnoVrijeme.class.php";


function ProvjeraIstekaSesije() {
    
    $objekt = new VirtualnoVrijeme();
    $trenutnoVrijeme = $objekt->DohvatiVrijeme();
    $trenutnoVrijeme = strtotime($trenutnoVrijeme);

    $config = new Konfiguracija();
    $trajanjeSesije = $config->DohvatiTrajanjeSesije();

    $vrijemePrijave = $_COOKIE["VrijemePrijave"];

    if (($trenutnoVrijeme - $vrijemePrijave) > $trajanjeSesije) {

        header("Location:Odjava.php");
    }
}
