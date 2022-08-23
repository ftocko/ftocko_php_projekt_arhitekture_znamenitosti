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
        <title>Galerija znamenitosti</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxGalerija.js"></script>
        <script src="javascript/ajaxGodineSelect.js"></script>
        
        
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
      
      godina = "";
      godina = '{$godina}';
      
      if(godina===""){
          
          PrikaziGaleriju();
            
         $(document).on('change', '#page', function () {

          PrikaziGalerijuSelectionChanged();


       });
          

     }
     
     else{
         
         PrikaziGalerijuGodina(godina);
         
         $(document).on('change', '#page', function () {

          PrikaziGalerijuGodinaSelectionChanged(godina);


       });
         
     }
           
          
    });
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Galerija znamenitosti </h2>
            
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
                 <div id style="text-align:center;">
                     
                 <h2> Galerija </h2>
                 
                     <label> Odaberite godinu: </label>

                     <form method="post" id="obrazacBrojMaterijalaGodina" action="">
                     <select id="godina" name="godina"> </select>
                     <input name="submitGodina" type="submit" id="FilterGodina" value="Filtriraj">
                     <input name="submitSve" type="submit" id="submitSve" value="Filtriraj sve">
                     <br> <br>
                     </form>
                     
                     <form method="post" id="obrazacBrojMaterijala" action="">
                     <label> Broj materijala po stranici: </label>
                     <input id="brojMaterijala" type="text" name="broj">
                     <input type="submit" name="submit" id="Odredi" value="Odredi">
                     </form>
                     
                     <br> <br>
                     
                     <select id="page" name="page[]"> {$opcije} </select>
                      
                 
                 <div id="galerija" style="display: flex;flex-flow: row wrap;"> </div>
                 
                 
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

