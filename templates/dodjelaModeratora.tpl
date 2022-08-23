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
        <title> Dodjela moderatora </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxModeratorGrad.js"> </script>
        
        
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
            <h2> Dodjela moderatora </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}
                 
            </dl>
            
        </header>

        <br>
        <div style="text-align:center;">
            
        <form id="forma" method="post" action="{$smarty.server.PHP_SELF}">
            <div>
                <label> Odaberite korisnika: </label>
            </div>
            <select id="Korisnici" name="selectKorisnici"> </select>
            <br> <br>
            <div>
                <label> Odaberite grad: </label>
            </div>
            <select id="Gradovi" name="selectGradovi"> </select>
            <br> <br>
            <input type="submit" name="submit" id="gumbDodijeli" value="Dodijeli">
            <input type="reset" name="reset" id="gumbReset" value="Odustani">
            
            </form>
        <br> <br>
        <p> {$poruka} </p>
        </div>
           
        <div style="text-align:center;">
        <h2 style="color:black;"> Pregled moderatora i gradova </h2>
        <table id="tablicaUpravljanja" border="2" style="margin-left:auto;margin-right:auto;text-align:center;width:50%;">
            <thead style="color:black; background-color:white;"> 
            <th> Moderator </th>
            <th> Grad </th>
            <th> Oduzimanje moderatora </th>
            </thead>
            
        </table>
        </div>
        <br> <br>
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>



