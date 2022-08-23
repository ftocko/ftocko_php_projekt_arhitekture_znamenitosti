<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="CSS/ftocko.css">
        <title> Prijedlozi za znamenitosti</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxPrijedlozi.js"> </script>
        
        
    </head>
    
       
    <script>
    
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
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Prijedlozi za znamenitosti </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}
                 
                 {if $uloga==="2"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}
                 
                 {if $uloga==="3"}
                  <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}
                 
                 {if $korisnik===null}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 {/if}
                 
            </dl>
            
        </header>

        <br>
        <div style="text-align:center;">
            
            <h2 style="color:black;"> Popis prijedloga korisnika </h2>
        
            <table border="3" id="popisPrijedloga" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Id </th>
                 <th> Naziv grada </th>
                 <th> Naziv znamenitosti </th>
                 <th> Opis znamenitosti </th>
                 <th> Nadimak </th>
                 <th> Ime i prezime </th>
                 <th> Napravi zahtjev </th>
                </thead>
            </table>
        
        </div>
        <br>
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="page" name="page[]"> {$opcije} </select>
        </form>
        </div>
        <br>     
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>


