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
        <title>Gradovi</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxStatistikaGradovi.js"> </script>
        <script src="javascript/ajaxGradovi.js"> </script>
        <script src="javascript/gradoviPomoc.js"> </script>
        
        
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
            <h2> Gradovi </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php"> Glavni zaslon </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="SigurnosnaKopija.php"> Sigurnosna kopija </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="GalerijaZnamenitosti.php"> Galerija znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Znamenitosti.php"> Znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Prijedlozi.php"> Prijedlozi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Zahtjevi.php"> Zahtjevi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 {/if}
                 
                 {if $uloga==="2"}
                 <dt class="ElementListe"> <a class="element" href="GalerijaZnamenitosti.php"> Galerija znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Znamenitosti.php"> Znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Prijedlozi.php"> Prijedlozi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Zahtjevi.php"> Zahtjevi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 {/if}
                 
                 {if $uloga==="3"}
                 <dt class="ElementListe"> <a class="element" href="GalerijaZnamenitosti.php"> Galerija znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Prijedlozi.php"> Prijedlozi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 {/if}
                 
                 {if $korisnik===null}
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 {/if}
                 
            </dl>
            
            {if $uloga===null}
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
            {/if} 
            
            {if $uloga==="3"}
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
                <button id="gumbZahtjev"  style="position: absolute;left:80%;bottom:40%;"> <a style="color:black;" href="DodavanjeZahtjeva.php"> Novi zahtjev za znamenitost </a> </button>
                <button id="gumbMaterijal"  style="position: absolute;left:80%;bottom:30%;"> <a style="color:black;" href="DodavanjeMaterijala.php"> Novi materijal za znamenitost </a> </button>
            {/if} 
            
            {if $uloga==="2"}
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
                <button id="gumbZahtjev"  style="position: absolute;left:80%;bottom:40%;"> <a style="color:black;" href="DodavanjeZahtjeva.php"> Novi zahtjev za znamenitost </a> </button>
                <button id="gumbMaterijal"  style="position: absolute;left:80%;bottom:30%;"> <a style="color:black;" href="DodavanjeMaterijala.php"> Novi materijal za znamenitost </a> </button>
            {/if} 
            
            
            {if $uloga==="1"}
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:40%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
                <button id="gumbDodajGrad" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjeGradova.php"> Dodaj novi grad </a> </button>
                <button id="gumbDodijeliModeratore" style="position: absolute;left:80%;bottom:60%;"> <a style="color:black;" href="DodjelaModeratora.php"> Dodijeli moderatore </a> </button>
                <button id="gumbZahtjev"  style="position: absolute;left:80%;bottom:30%;"> <a style="color:black;" href="DodavanjeZahtjeva.php"> Novi zahtjev za znamenitost </a> </button>
                <button id="gumbMaterijal"  style="position: absolute;left:80%;bottom:20%;"> <a style="color:black;" href="DodavanjeMaterijala.php"> Novi materijal za znamenitost </a> </button>
            {/if} 
           
            
        </header>
            
        <div id="pomoc" style="position: absolute; top: 32%; right: 90%; text-align: center; background:black; color: white;" onclick="pomoc();"> 
                   <h2 id="text"> POMOĆ! </h2>
        </div>
        
        <div class="Sadrzaj" style="text-align:center;">
            
            <h2 style="color:black;font-size:22px;"> Odaberite grad </h2>
            
            <table id="gradovi" style="color:black; text-align:center; background-color:white; margin-left: auto; margin-right: auto; width:50%; text-transform: uppercase; border-color:white;" border="2">
                
            </table>
            
           
             

        </div>
        <br>
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="stranica" name="stranica[]"> {$opcijeGradovi} </select>
            &nbsp;&nbsp;
            <label for="pretraga"> Pretraga po imenu grada: </label>
            <input id="pretraga" name="pretraga" type="text">
        </form>
        
        </div>
        
        <br> <br>
        
        
        <div style="text-align: center;">
            
            <h2 style="color:black;"> Statistika broja znamenitosti po gradovima </h2>
        
            <table border="3" id="statistikaGradova" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Naziv grada </th>
                 <th> Broj znamenitosti </th>
                </thead>
            </table>
        </div>
        
        <br>
        
        <div style="text-align:center;">
            
        <button id="gumbBrojZnam" class="gumbSort"> Sortiraj po broju znamenitosti </button>
        
        </div>
       
        <br> <br>
        
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
