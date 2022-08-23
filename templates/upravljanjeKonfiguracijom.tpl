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
        <title>Upravljanje konfiguracijom</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        
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
    
    function ResetiranjeUvjeta(currentTime){
        
         document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';

    }
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Upravljanje konfiguracijom </h2>
            
            <dl class="ListaStranica">
                
                 <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php"> Glavni zaslon </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
            </dl>
            

            
        </header>
        
        
        <div class="Sadrzaj" style="text-align:center;">
            
            <h2 style="font-size:24px;"> Virtualno vrijeme </h2>
            
            <form name="obrazacVrijeme" id="obrazacVrijeme" action="{$smarty.server.PHP_SELF}" method="post">
                
                <fieldset style="width:50%;margin-left:auto;margin-right:auto;">
                    <legend> <a id="postavi" href="http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html" target="_blank"> Postavi virtualno vrijeme </a> </legend>
                    <label for="nacinSpremanja">Način spremanja:</label>
                    <br>
                    <input type="radio" id="nacinSpremanja" name="nacinSpremanja" value="json" checked>JSON
                </fieldset>
               
                <input type="submit" class="submitPostavi" name="submitPostavi" value="Postavi">                  
            </form>
            
        </div>
            
        <br>
        <hr>
        
        <div style="text-align:center">
        <form name="obrazacStranicenje" id="obrazacStranicenje" action="{$smarty.server.PHP_SELF}" method="post">
            
            <h2 style="font-size:24px;"> Postavite broj redaka za straničenje: </h2>
            <input type="text" name="stranicenje" id="stranicenje" placeholder="npr. 10">
            <input name="submitStranicenje" type="submit" id="submitStranicenje" value="Postavi">
            
        </form>
        </div>
        
        <div style="text-align:center;">
        <form name="obrazacBrojPrijava" id="obrazacBrojPrijava" action="{$smarty.server.PHP_SELF}" method="post">
            
            <h2 style="font-size:24px;"> Postavite broj neuspješnih prijava: </h2>
            <input type="text" name="brojPrijava" id="brojPrijava" placeholder="npr. 5">
            <input name="submitBrojPrijava" type="submit" id="submitBrojPrijava" value="Postavi">
            
        </form>
        </div>
        
        <div style="text-align:center;">
        <form name="obrazacSesija" id="obrazacSesija" action="{$smarty.server.PHP_SELF}" method="post">
            
            <h2 style="font-size:24px;"> Postavite trajanje sesije (sekunde): </h2>
            <input type="text" name="sesija" id="sesija" placeholder="npr. 1800 s za 30 min">
            <input name="submitSesija" type="submit" id="submitSesija" value="Postavi">
            
        </form>
        </div>
        
        <div style="text-align:center;">
        <form name="obrazacLink" id="obrazacLink" action="{$smarty.server.PHP_SELF}" method="post">
            
            <h2 style="font-size:24px;"> Postavite trajanje linka za aktivaciju kreiranog računa (dan): </h2>
            <input type="text" name="link" id="link" placeholder="npr. 14 ">
            <input name="submitLink" type="submit" id="submitLink" value="Postavi">
            
        </form>
        </div>
        
        <div style="text-align:center;">
        <form name="obrazacUvjeti" id="obrazacUvjeti" action="{$smarty.server.PHP_SELF}" method="post">
            
            <h2 style="font-size:24px;"> Postavite trajanje kolačića za uvjete korištenja (dan): </h2>
            <input type="text" name="uvjeti" id="uvjeti" placeholder="npr. 7 ">
            <input name="submitUvjeti" type="submit" id="submitUvjeti" value="Postavi">
            <input type="submit" id="resetUvjeti" name="resetiranjeKolacica" onclick="ResetiranjeUvjeta();" value="Resetirajte kolačiće za uvjete korištenja">
            
        </form>
        </div>
        
        <br>
        <hr>
 
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>
            <p> Vrijeme sustava: {$vrijeme}</p> 
        </footer>

    </body>
</html>


