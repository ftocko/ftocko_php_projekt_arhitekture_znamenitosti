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
        <title>Sigurnosna kopija</title>
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
     
    </script>
    
    <body>
        <header>
                <h2> Sigurnosna kopija </h2>
                
            <dl>
                
                {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 </figure>
                 {/if}    
                 
            </dl>
    
        </header>
                 
        <br> <br>
                 
        <div style="text-align:center;">
                        
                    <form name="kopijaObrazac" id="kopijaObrazac" action="" method="post" enctype="multipart/form-data">
                    <fieldset style="width:50%;margin-left:auto;margin-right:auto;">
                    <legend> Sigurnosna kopija znamenitosti i materijala </legend>
                        
                    <br>
                    
                    <label for="emailAdresa"> Unesite E-mail adresu:  </label>
                    <input type="text" name="emailAdresa" id="emailAdresa">
                             
                    <br> <br> 
                        
                    <label for="datoteka"> Odaberite datoteku:  </label>
                    <input type="file" name="datoteka" id="datoteka">
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                    
                    <br> <br>  
                    
                    <input type="submit" name="NapraviSecKopiju" id="NapraviSecKopiju" value="Napravi sigurnosnu kopiju">
                    <input type="submit" name="VratiIzSecKopije" id="VratiIzSecKopije" value="Vrati iz sigurnosne kopije">
                    
                    </fieldset>
                        
                    </form>
                        
                    
                    <br>
                    
                    <p> {$poruka} </p>
                    
         </div>
                 
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>
