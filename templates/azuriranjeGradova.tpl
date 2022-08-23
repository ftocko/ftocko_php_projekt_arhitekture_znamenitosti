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
        <script src="javascript/ajaxGrad.js"> </script>
        
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
    
    $(document).ready(function () {
        
        GetGrad('{$grad}');
    
    });
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Dodavanje gradova </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="DodavanjeGradova.php"> Dodavanje gradova </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 {/if}
                 
            </dl>
            
        </header>

        <br>
        <div style="text-align:center;">
            
        <form id="forma" method="post" action="{$smarty.server.PHP_SELF}">
                <div>
                <label> Naziv grada:</label>
                </div>
                <input type="text" name="nazivGrada"id="nazivGrada" size="20">
                <br> <br>
                <div>
                <label> Naziv županije:</label>
                </div>
                <input type="text" name="nazivZupanije" id="nazivZupanije" size="20">
                <br> <br>
                <div>
                <label> Ime i prezime gradonačelnika:</label>
                </div>
                <input type="text" name="imePreGradonacelnika" id="imePreGradonacelnika" size="20">
                <br> <br>
                <input class="GumbAzurirajGrad" type="submit" name="submit" id="submit" value="Ažuriraj grad" style="height:50px;width:150px;">
                <input class="GumbOdustani"type="reset" name="reset" id="reset" value="Odustani" style="height:50px;width:150px;">
                <br>
            </form>
        <br> <br>
        <p> {$poruka} </p>
        </div>
             
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>



