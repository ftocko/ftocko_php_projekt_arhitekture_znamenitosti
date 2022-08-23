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
        <title>{$title}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxZnamenitostPodaci.js"> </script>
        
        
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
    
            DohvatiPodatkeZnamenitosti('{$title}');
    
        });
    
    </script>
    
    <body>
        <header>
            <h2> {$title} </h2>
            
            <dl class="ListaStranica">
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Grad.php?grad={$grad}"> Grad </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
                 {/if}
                 
                 {if $uloga==="2"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Grad.php?grad={$grad}"> Grad </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                
                 {/if}
                 
                 {if $uloga==="3"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Grad.php?grad={$grad}"> Grad </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
                 {/if}
                 
                 {if $korisnik===null}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Grad.php?grad={$grad}"> Grad </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 {/if}
                 
            </dl>
          
       
                 
        </header>
                 <div style="text-align:center;">
                     
                 <h2> Popis </h2>
                 <form>
                     <label for="kreirao">  <strong> Kreirao: </strong> </label>
                     <input type="text" id="kreirao" name="kreirao" readonly style="border-color:black;;">
                     <br>
                     <br>
                     <label for="predlozio"> <strong> Predložio: </strong> </label>
                     <input type="text" id="predlozio" name="predlozio" readonly style="border-color:black;"> 
                     <br>
                     <br>
                     &nbsp; <label for="godina"> <strong> Godina: </strong> </label>
                     <input type="text" id="godina" name="godina" readonly style="border-color:black;"> 
                     <br>
                 </form>
                 
                 </div>
                 
                 <br>
                 <br>
                 
               
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    
    </body>
</html>
