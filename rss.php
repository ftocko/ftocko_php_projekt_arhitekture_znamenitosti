<?php

include "biblioteke/baza.class.php";

function DohvatiSveGradove() {

    $veza = new Baza();
    $veza->spojiDB();

    $gradovi = array();
    $upit = "select naziv_grada from grad;";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $gradovi [] = $red["naziv_grada"];
    }

    $veza->zatvoriDB();
    return $gradovi;
}

$baza = new Baza();
$baza->spojiDB();

$gradovi = DohvatiSveGradove();




header("Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title> Zadnjih 10 dodanih znamenitosti po svakom gradu </title>
<link>https://www.architecture.com/</link>
<description> Zadnjih 10 dodanih znamenitosti po svakom gradu </description>
<language> en-us </language>";

for ($i = 0; $i < count($gradovi); $i++) {

    $sqlUpit = "select g.naziv_grada, zn.naziv_znamenitosti, zn.opis, z.zahtjev_id from grad g inner join zahtjev z on z.grad_id = g.grad_id inner join znamenitost zn on zn.zahtjev_id = z.zahtjev_id where g.naziv_grada = '{$gradovi[$i]}' order by 4 desc limit 10;";
    $rezultat = $baza->selectDB($sqlUpit);

    echo "<item> Grad {$gradovi[$i]}:
           <title>Zadnje dodane znamenitosti za grad {$gradovi[$i]} </title>
           <description> U nastavku prikaz zadnje dodanih znamenitosti za taj grad </description>";
           

    while ($red = mysqli_fetch_assoc($rezultat)) {

        $znamenitost = $red["naziv_znamenitosti"];
        $opisZnamenitosti = $red["opis"];

        echo "<item> Znamenitost:
           <title>$znamenitost </title>
           <description> $opisZnamenitosti </description>
           </item>";
    }
    
    echo "</item>";
}


echo "</channel> </rss>";

$baza->zatvoriDB();

