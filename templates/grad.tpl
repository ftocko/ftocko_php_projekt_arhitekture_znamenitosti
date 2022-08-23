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
    
    $(document).ready(function(){
        
        AjaxFunction('{$title}');
        GetGradLista('{$title}');
        
        $("#page").change(function(){
            
            AjaxFunctionSelectionChanged('{$title}');
            
        });
        
         $("#pretraga").keyup(function () {
             
             PretragaPoZnamenitosti('{$title}');
             
         });
            
      
        
        
    });
         
    </script>
    
    <body>
        <header>
                <h2> {$title} </h2>
                
                <dl>
                
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
                 
                 {if $korisnik===null}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 {/if}
                 
            </dl>
          
       
                 
        </header>
                 
                <br> <br>
                 
                <div style="text-align:center;">
                <label> Naziv grada: </label>
                <input type="text" id="naziv">
                <label> Naziv županije: </label>
                <input type="text" id="zupanija">
                <label> Naziv gradonačelnika: </label>
                <input type="text" id="gradonacelnik">
                </div>
                <br>
                <br>
                 
                <div style='text-align:center;'>
                     <h2 style="color:black;"> Znamenitosti: </h2>
                     
                      {if $uloga==="1"}
                     <button id="GumbAzurirajGrad" style="position: absolute;left:85%;bottom:60%;"> <a href="AzuriranjeGradova.php?grad={$title}" style="color:black;"> Ažuriraj grad </a> </button>
                      {/if}
                      
                 <dl id="GradPodaci" style='width:50%; margin-left: auto; margin-right: auto;'> </dl>
                 
                 
                 </div>
                 
                 <br>
                 
                 <div style="text-align:center;">
                    <form style="margin-left: auto; margin-right: auto;">
                        <select id="page" name="page[]"> {$opcije} </select>
                        &nbsp;&nbsp;
                        <label for="pretraga"> Pretraga po imenu znamenitosti: </label>
                        <input id="pretraga" name="pretraga" type="text">
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
