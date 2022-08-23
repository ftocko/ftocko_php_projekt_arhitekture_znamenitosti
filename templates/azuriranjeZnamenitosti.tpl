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
        <title>Ažuriranje znamenitosti</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
        <script src="javascript/ajaxZnamenitostAzuriranje.js"> </script>
        
        
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
        
        DohvatiZnamenitost({$id});
        
    });
    
    
    </script>
    
    <body>
        <header>
            <h2> Ažuriranje znamenitosti </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Znamenitosti.php"> Znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
                 {/if}
                 
                 {if $uloga==="2"}
                     
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Znamenitosti.php"> Znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                
                 {/if}
                 
                 
            </dl>
              
        </header>
        
               <br>
               
               <div style="text-align:center;">
               <form id="formAzuriranjeZnam" method="post" action="{$smarty.server.PHP_SELF}">
                
               <fieldset style="width:50%;margin-left:auto;margin-right:auto;">
                <legend> Ažuriranje znamenitosti </legend>
                <div>
                <label> ZnamenitostID: </label>
                </div>
                <input type="text" readonly id="znamenitost" name="znamenitost"> </select>
                <br> <br>
                <div>
                <label> ZahtjevID: </label>
                </div>
                <input type="text" readonly id="zahtjev" name="zahtjev"> </select>
                <br> <br>
                <div>
                <label>ModeratorID:</label>
                </div>
                <input type="text" readonly name="moderator" id="moderator">
                <br> <br>
                <div>
                <label>Predlozio:</label>
                </div>
                <input type="text" name="predlozio" id="predlozio">
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                <label>Naziv znamenitosti:</label>
                </div>
                <input type="text" name="nazivZnam" id="nazivZnam">
                <br> <br>
                <div>
                <label> Opis znamenitosti: </label>
                </div>
                <textarea type="text" name="opisZnam" id="opisZnam" rows="5" cols="52"> </textarea>
                <br> <br>
                <div>
                <label> Godina znamenitosti: </label>
                </div>
                <input type="text" name="godinaZnam" id="godinaZnam">
                <br> <br>
                <div>
                <label> Datum i vrijeme dodavanja: </label>
                </div>
                <input type="text" name="dateTime" readonly id="dateTime">
                <br> <br>
                <input class="GumbZnamenitost" type="submit" name="submit" id="submit" value="Ažuriraj znamenitost" style="height:50px;width:170px;"> &nbsp;&nbsp;&nbsp;
                <input class="GumbOdustani"type="reset" name="reset" id="reset" value="Odustani" style="height:50px;width:160px;">
                <br>
                
            </fieldset>
            </form>
               
            <br>
            <p> {$poruka} </p>
            <br>
               
            </div>
                
            
               
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

        
    
    </body>
</html>


