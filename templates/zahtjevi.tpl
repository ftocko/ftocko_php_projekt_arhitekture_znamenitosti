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
        <title> Zahtjevi korisnika </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxKorisniciZahtjevi.js"></script>
        <script src="javascript/ajaxZahtjeviModerator.js"></script>    
        
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
    
    $(document).ready(function(){
    
      AjaxFunction('{$sendUpit}');
      ZahtjeviFunction('{$sendUpitZahtjevi}');
      
      $("#page").change(function(){
          
            AjaxSelectionChanged('{$sendUpit}');
      });
      
      $("#stranica").change(function(){
          
            ZahtjeviModeratorSelectionChanged('{$sendUpitZahtjevi}');
      });
       
    
    });
    
    
    </script>
    
    <body>
        <header>
            <h2> Zahtjevi korisnika </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}
                 
                 {if $uloga==="2"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}             
                 
            </dl>
            
        </header>

        <div style="text-align:center;">
            <h2> Korisnici i zahtjevi </h2>
        </div>
        <table id="tablicaKorisnikZahtjev" border="3" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
            
            <thead style="color:black; background-color:white;">
            <th> Korisnik </th>
            <th> Broj zahtjeva </th>
            <th> Status </th>
            <th> Blokiranje/Deblokiranje </th>
            
            </thead> 
            
        </table>
        <br> 
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="page" name="page[]"> {$opcije} </select>
        </form>
        <p> {$poruka} </p>
        </div>
        
        <br>
        
        <div style="text-align:center;">
            
            <h2> Zahtjevi za znamenitosti </h2>
            
            <table id="tablicaZahtjevi" border="3" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
            
                <thead style="color:black; background-color:white;">
                
                    <th> Id </th>
                    <th> Korisnik </th>
                    <th> Grad </th>
                    <th> Naziv znamenitosti </th>
                    <th> Opis znamenitosti </th>
                    <th> Godina znamenitosti </th>
                    <th> Status </th>
                    <th> PrijedlogId </th>
                    <th> Potvrđivanje/Odbijanje </th>
            
                </thead> 
            
            </table>    
        
        </div>
        
        <br>
        
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="stranica" name="stranica[]"> {$opcijeZahtjevi} </select>
        </form>
        
            
        <br>     
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>
 

    </body>
</html>
