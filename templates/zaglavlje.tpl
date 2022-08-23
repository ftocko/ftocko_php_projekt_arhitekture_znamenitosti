<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="design" rel="stylesheet" href="CSS/ftocko.css">
        <title>Početna stranica</title>
        <script src="javascript/pocetna.js"> </script>
    </head>
    
    <script>
        
        function DohvatiKolacic(kljuc) {
    var keyValue = document.cookie.match('(^|;) ?' + kljuc + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] :
            null;
}

function PostaviKolacic(kljuc, vrijednost) {

    let expires = new Date();
    expires.setTime(expires.getTime() + {$trajanjeKolacica} * 24 * 60 * 60 * 1000);

    document.cookie = kljuc + '=' + vrijednost + "; expires=" + expires.toGMTString() + ";";
}
        
    function ProvjeraUvjeta() {

    if (!DohvatiKolacic("UvjetiKoristenja")) {

        var rezultat = confirm("Prihvaćate li uvjete korištenja? ");

        if (rezultat) {

            vrijeme = new Date();
            vrijemeMonth = vrijeme.getMonth() + 1;

            datumTimestamp = new Date();
            timestamp = Math.round(datumTimestamp.getTime() / 1000);
            
            PostaviKolacic("VrijemePrihvacanja", timestamp);
            PostaviKolacic("UvjetiKoristenja", "Prihvaćeni");


            alert("Uvjeti korištenja su prihvaćeni!");

        } else {
            alert("Prihvaćanje uvjeta korištenja je obavezno!");
            location.reload();
        }
    }
    

}

function BrisanjeKolacicaUvjeta(){
    
    document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';
}

{if $obrisi == "true"}
BrisanjeKolacicaUvjeta();
{/if}
    
ProvjeraUvjeta();

    
{if $resetirani == 1}
    
document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';
window.location.href = "index.php?unreset=unreset";

{/if}
        
    </script>
    
    <body>
        <header>
            <h2> Početna stranica </h2>
            
            <dl class="ListaStranica">
                <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php">Ulaz kao gost </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Prijava.php">Prijava </a> </dt>
                <dt class="ElementListe"> <a class="element" href="O_autoru.php">O autoru </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Dokumentacija.php">Dokumentacija </a> </dt>
                <dt class="ElementListe"> <a class="element" href="privatno/korisnici.php">Korisnici </a> </dt>
                
            </dl>
            
            <p align="center"> Niste registrirani?&nbsp; <a href="Registracija.php"> Registracija </a> </p>
            
            <div style="display: flex;flex-flow: row wrap; text-align:right;">
            <figure style="margin-left:auto;">
            <img id="designLogo" src="multimedija/design_icon.png" height="50" width="50">
            <img id="designAccesibility" src="multimedija/pristupacnost.jpg" height="50" width="50" onclick="PrilagodbaDisleksije();">
            </figure>
            </div>
            
            
            
            
        </header>
        
