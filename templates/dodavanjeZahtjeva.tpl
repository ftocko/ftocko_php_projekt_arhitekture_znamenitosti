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
        <title> Dodavanje zahtjeva</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxGradoviSelectSpecial.js"> </script>
        <script src="javascript/ajaxZahtjevi.js"> </script>
        <script src="javascript/validacijaDodavanjeZahtjeva.js"> </script>
        
        
        
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
        
        NapuniComboBoxGrad('{$nazivGrad}');
        
        {if $status==0}
            $("#submit").prop("disabled", true);
            alert("Ne možete dodavati nove zahtjeve jer ste blokirani!");
        {/if}
            
        
        $("#zahtjevi").submit(function(){
            
            ValidirajZahtjeve();
        });    
    
        
    });
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Dodavanje zahtjeva </h2>
            
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
                 
            </dl>
            
        </header>

        <br>
        <div style="text-align:center;">
            
        <form id="zahtjevi" method="post" action="{$smarty.server.PHP_SELF}">
                
                <div>
                <label> Odaberite grad:</label>
                </div>
                <select id="grad" name="grad"> </select>
                <br> <br>
                <div>
                <label> Unesite naziv znamenitosti:</label>
                </div>
                <input type="text" name="nazivZnamenitosti" value="{$nazivZnam}" id="nazivZnamenitosti" size="20">
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                <label> Unesite godinu znamenitosti:</label>
                </div>
                <input type="text" name="godinaZnamenitosti" id="godinaZnamenitosti" size="20">
                <br> <br>
                <div style="text-align:center;">
                <label> Unesite opis znamenitosti:</label>
                </div>
                <textarea name="opisZnamenitosti" id="opisZnamenitosti" rows="5" cols="52"> {$opisZnam} </textarea>
                <br> <br>
                <input class="GumbZahtjev" type="submit" name="submit" id="submit" value="Dodaj zahtjev" style="height:50px;width:150px;">
                <input class="GumbOdustani"type="reset" name="reset" id="reset" value="Odustani" style="height:50px;width:150px;">
                <br>
            </form>
        <br> <br>
        <p> {$poruka} </p>
        </div>
        
        <br>
        <div style="text-align:center;">
        <h2> Zahtjevi za znamenitosti </h2>
        </div>
        <table id="tablicaZahtjeva" border="3" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
            
            <thead style="color:black; background-color:white;">
            <th> Id </th>
            <th> Korisnik </th>
            <th> Grad </th>
            <th> Naziv znamenitosti </th>
            <th> Opis znamenitosti </th>
            <th> Godina znamenitosti </th>
            <th> Status </th>
            
            </thead> 
            
        </table>
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


