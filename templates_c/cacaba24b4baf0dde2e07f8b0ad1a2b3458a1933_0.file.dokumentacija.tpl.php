<?php
/* Smarty version 3.1.39, created on 2021-06-15 18:58:55
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/dokumentacija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c8dc4fb9a713_89807220',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cacaba24b4baf0dde2e07f8b0ad1a2b3458a1933' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/dokumentacija.tpl',
      1 => 1623776333,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c8dc4fb9a713_89807220 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="CSS/ftocko.css">
        <title>Dokumentacija</title>
    </head>
    
    <?php echo '<script'; ?>
>
    
    function DohvatiKolacic(kljuc) {
        var keyValue = document.cookie.match('(^|;) ?' + kljuc + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] :
                null;
    }

    function PostaviKolacic(kljuc, vrijednost) {

        let expires = new Date();
        expires.setTime(expires.getTime() + 7 * 24 * 60 * 60 * 1000);

        document.cookie = kljuc + '=' + vrijednost + "; expires=" + expires.toGMTString() + ";";
    }
    
    if (DohvatiKolacic("Dizajn")) {

            $trazeniDizajn = DohvatiKolacic("Dizajn");
            dizajn = document.getElementById("dizajn");
            dizajn.href = $trazeniDizajn;
    } 
    
    
    <?php echo '</script'; ?>
>
    
    <body style="background-color:white;">
        <header>
            <h2> Dokumentacija </h2>
            
             <dl class="ListaStranica">
                 
                <dt class="ElementListe"> <a class="element" href="index.php">Početna stranica </a> </dt>
                
            </dl>
        
        </header>

        <div class="Sadrzaj">
             
            <div style="text-align:left;">
                
            <h2> Opis projektnog zadatka: </h2>
            
            <pre style="font-size:15px;"> 
 Projektni zadatak je bio izraditi web aplikaciju za upravljanje znamenitostima. U web aplikaciji postoje 4 uloge: Administrator, moderator,
 registrirani korisnik i neregistrirani korisnik. Svaka uloga ima različita prava pristupa i korištenja aplikacije. Osim glavnih funkcionalnosti za
 upravljanje znamenitostima, web aplikacija mora sadržavati, neke općenite karakteristike svih web aplikacija, kao što su: dnevnik, upravljanje sesijom, 
 prijava, registracija, odjava, upravljanje konfiguracijom, upravljanje korisnicima itd. Glavne funkcionalnosti aplikacije, koje su raspodijeljene na različite
 uloge, pritom uloga više razine, može sve što i uloga niže razine su: dodjela moderatora, kreiranje gradova, kreiranje znamenitosti za gradove temeljem zahtjeva, 
 dodavanje zahtjeva i prijedloga za znamenitosti, postavljanje materijala za znamenitosti, pregled galerije znamenitosti, gradova, zahtjeva, prijedloga, znamenitosti,
 izrada i vraćanje podataka iz sigurnosne kopije znamenitosti i materijala, blokiranje i deblokiranje korisnika od upućivanja zahtjeva te praćenje zadnjih 10
 dodanih znamenitosti po svakom gradu putem RSS kanala.        
  
            </pre>
            </div>
            <hr>
        
        <div style="text-align:left;">
                
            <h2> Opis projektnog rješenja: </h2>
            
            <pre style="font-size:15px;"> 
 Projektno rješenje je implementirano u skladu s uputama projektnog zadatka. Web aplikacija sadrži općenite i glavne funkcionalnosti. U nastavku dokumentacije,
 navigacijski dijagrami jasno ilustriraju, načine korištenja aplikacije za svaku ulogu. Aplikacija radi s bazom podataka, čiji ERA dijagram je također prikazan
 u nastavku dokumentacije. Navigacijski dijagrami isto tako, na neki način određuju logičku arhitekturu aplikacije, što se tiče softvera. Svaki veći prikaz podataka u
 tablicama sadrži mehanizam straničenja. Aplikacija koristi virtualno vrijeme. Svaka uloga ima svoja prava pristupa. Dakle, radi se o jednoj klasičnoj web aplikaciji.
 Ona služi za upravljanje znamenitostima u Hrvatskoj.
       
            </pre>
            </div>
            <hr>
            
            <div style="text-align:left;">
            
            <h2> Era dijagram </h2>
            
            
            <p> Kliknite na sliku za veći prikaz iste! </p>
            
            </div>
            
            <div style="display: flex;flex-flow: row wrap;text-align:left;"">
                
                <figure> <a href="multimedija/era_dijagram.png" target="_blank"> <img src="multimedija/era_dijagram.png" height="200" width="200"> </a> <figcaption> ERA dijagram </ficaption> </figure>
                
            </div>
        
        <hr>
            
            <div style="text-align:left;">
            
            <h2> Navigacijski dijagrami </h2>
            
            
            <p> Kliknite na željenu sliku za veći prikaz iste! </p>
            
            </div>
            
            <div style="display: flex;flex-flow: row wrap;text-align:left;"">
                
                <figure> <a href="multimedija/Administrator.png" target="_blank"> <img src="multimedija/Administrator.png" height="200" width="200"> </a> <figcaption> Administrator </ficaption> </figure>
                <figure> <a href="multimedija/Moderator.png" target="_blank"> <img src="multimedija/Moderator.png" height="200" width="200"> </a> <figcaption> Moderator </ficaption> </figure>
                <figure> <a href="multimedija/RegistriraniKorisnik.png" target="_blank"> <img src="multimedija/RegistriraniKorisnik.png" height="200" width="200"> </a> <figcaption> Registrirani korisnik </ficaption> </figure>
                <figure> <a href="multimedija/NeregistriraniKorisnik.png" target="_blank"> <img src="multimedija/NeregistriraniKorisnik.png" height="200" width="200"> </a> <figcaption> Neregistrirani korisnik </ficaption> </figure>
                
            </div>
        
        <hr>
        
        <div style="text-align:left;">
                
            <h2> Opis skripata (JS i PHP) </h2>
            
            <pre style="font-size:15px;"> 
 Glavne PHP skripte koje sadrže poslovnu logiku web aplikacije se nalaze u korijenskom direktoriju projekta. Postoje i PHP skripte za sučelje aplikacije koje se nalaze
 u direktoriju "sucelje_biblioteke". PHP skripte koje predstavljaju klase i zaglavlje nalaze se u direktoriju "biblioteke". U direktoriju "privatno" nalazi se posebna
 PHP skripta koja ispisuje korisnike i zaštićena je .htaccess-om te u direktoriju "DodavanjeZaHtaccess" je PHP skripta koja generira tekstualnu datoteku za .htaccess. Što se tiče skripata JavaScript-a
 u direktoriju "javascript" nalaze se sve korištene JS skripte. Skripte s prefiksom "ajax" služe za kreiranje korisničkog sučelja putem Ajax-a, a ostale skripte su uobičajene,
 tj. implementacija su pomoći, promjene dizajna i validacije za registraciju. Ranije navedene, PHP skripte u direktoriju "sucelje_biblioteke" se koriste kod "ajax skripata" i 
 one isporučuju podatke u JSON formatu. Sve PHP skripte u korijenskom direktoriju projekta, kao što je ranije navedeno, implementiraju glavne funkcionalnosti aplikacije.
       
            </pre>
            </div>
            <hr>
            
              
        <div style="text-align:left;">
                
            <h2> Opis korištenih tehnologija i alata </h2>
            
            <pre style="font-size:15px;"> 
 U ovom projektu, za programiranje na strani poslužitelja korišten je PHP, a za programiranje na strani klijenta JavaScript. Za izgled aplikacije korištena je
 kombinacija HTML i CSS te nešto malo JavaScript. PHP određuje glavnu poslovnu logiku aplikacije. Za lakše i preglednije korištenje PHP-a,
 korišten je sustav predložaka Smarty. Za korisničko sučelje korištena je tehnologija Ajax, koja preuzima podatke iz poslužitelja u JSON formatu. Korištena je i .htaccess
 datoteka za zaštitu i autorizaciju direktorija "privatno". Za administriranje baze podataka korišteni su: SUBP MySQL i tehnologija phpMyAdmin.
       
            </pre>
            </div>
            <hr>
            
            <div style="text-align:left;">
                
            <h2> Opis završenosti projekta </h2>
            
            <pre style="font-size:15px;"> 
 Projekt je u većoj mjeri dovršen. U istom su implementirane sve glavne funkcionalnosti tj. poslovna logika aplikacije i većina osnovnih funkcionalnosti iste.
 Dijelovi iz glavnih kategorija, koji nisu napravljeni su: Pretraživanje i sortiranje kolona, Prilagođavanje dizajna i ispis i Statistike grafički prikazi. Od posebnih osobina
 realiziran je samo Smarty.
       
            </pre>
            </div>
            

        </div>
       

        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>
<?php }
}
