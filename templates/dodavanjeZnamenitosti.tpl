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
        <title>Dodavanje znamenitosti</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
        <script src="javascript/ajaxZnamenitostDodavanje.js"> </script>
        
        
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
        
        DohvatiZahtjevZaZnamenitost({$id},'{$korime}');
        
        
    });
    
  
   
    </script>
    
    <body>
        <header>
            <h2> Dodavanje znamenitosti </h2>
            
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

               <div style="text-align:center;">
               <form id="formZnamenitost" method="post" action="{$smarty.server.PHP_SELF}">
                
               <fieldset style="width:50%;margin-left:auto;margin-right:auto;">
                <legend> Dodavanje nove znamenitosti </legend>
                <div>
                <label> ZahtjevID: </label>
                </div>
                <input type="text" readonly id="zahtjev" name="zahtjev"> </select>
                <br> <br>
                <div>
                <label>Moderator:</label>
                </div>
                <input type="text" name="moderator" readonly id="moderator">
                <br> <br>
                <div>
                <label>Predlozio:</label>
                </div>
                <input type="text" name="predlozio" readonly id="predlozio">
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                <label>Naziv znamenitosti:</label>
                </div>
                <input type="text" name="nazivZnam" readonly id="nazivZnam">
                <br> <br>
                <div>
                <label> Opis znamenitosti: </label>
                </div>
                <textarea type="text" name="opisZnam" id="opisZnam" rows="5" cols="52"> </textarea>
                <br> <br>
                <div>
                <label> Godina znamenitosti: </label>
                </div>
                <input type="text" name="godinaZnam" id="godinaZnam" readonly>
                <br> <br>
                <input class="GumbZnamenitost" type="submit" name="submit" id="submit" value="Dodaj znamenitost" style="height:50px;width:160px;"> &nbsp;&nbsp;&nbsp;
                <input class="GumbOdustani"type="reset" name="reset" id="reset" value="Odustani" style="height:50px;width:150px;">
                <br>
                
            </fieldset>
            </form>
            <br> <br>
            
            <p> {$msg} </p>
            </div>
                
            
               
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

        
    
    </body>
</html>


