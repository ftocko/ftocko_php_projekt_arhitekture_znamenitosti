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
        <title> Dodavanje gradova</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxGradoviPregled.js"> </script>
        
        
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
            <h2> Dodavanje gradova </h2>
            
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
                <label> Unesite naziv grada:</label>
                </div>
                <input type="text" name="nazivGrada" id="nazivGrada" size="20">
                <br> <br>
                <div>
                <label> Unesite naziv županije:</label>
                </div>
                <input type="text" name="nazivZupanije" id="nazivZupanije" size="20">
                <br> <br>
                <div>
                <label> Unesite ime i prezime gradonačelnika:</label>
                </div>
                <input type="text" name="imePreGradonacelnika" id="imePreGradonacelnika" size="20">
                <br> <br>
                <input class="GumbDodajGrad" type="submit" name="submit" id="submit" value="Dodaj grad" style="height:50px;width:150px;">
                <input class="GumbOdustani"type="reset" name="reset" id="reset" value="Odustani" style="height:50px;width:150px;">
                <br>
            </form>
        <br> <br>
        <p> {$poruka} </p>
        </div>
        
         <div class="PregledGradova" style="text-align:center;">
            
            <h2 style="color:black;font-size:22px;"> Pregled gradova </h2>
            
            <table id="gradovi" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%; border-color:white;" border="2">
                
                <thead style="color:black; background-color:white;">
                    
                <th> Id </th>
                <th> Naziv grada </th>
                <th> Naziv županije </th>
                <th> Gradonačelnik </th>
                <th> Ažuriranje gradova </th>
                    
                </thead>
                
            </table>    

        </div>
        
        <br>
        
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="page" name="page[]"> {$opcijeGradovi} </select>
        </form>
        
        </div
        
        <br> <br>
             
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>


