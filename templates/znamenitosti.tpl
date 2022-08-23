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
        <title>Znamenitosti</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
        <script src="javascript/ajaxZnamenitostiModerator.js"> </script>
        
        
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
        
        
        GetZnamenitostiFunction('{$sendUpit}');
        
        $("#page").change(function(){
            
            GetZnamenitostiSelectionChanged('{$sendUpit}');
            
        });

        
    });
    

    
    
    
    </script>
    
    <body>
        <header>
            <h2> Znamenitosti </h2>
            
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
                     
                    <h2> Popis znamenitosti </h2>
            
                    <table id="tablicaZnamenitosti" border="3" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
            
                        <thead style="color:black; background-color:white;">
                
                            <th> Id </th>
                            <th> ZahtjevId </th>
                            <th> Moderator </th>
                            <th> Predlozio </th>
                            <th> Naziv znamenitosti </th>
                            <th> Godina znamenitosti </th>
                            <th> Datum i vrijeme dodavanja </th>
                            <th> Opis znamenitosti </th>
                            <th> Ažuriranje znamenitosti </th>
            
                       </thead> 
            
                </table>  
                 
               </div>
                 
               <br>
               
               <div style="text-align:center;">
                   
                    <form style="margin-left: auto; margin-right: auto;">
                        <select id="page" name="page[]"> {$opcije} </select>
                    </form>
                    
              </div>
        
              
            <br> <br>
               
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

        
    
    </body>
</html>

