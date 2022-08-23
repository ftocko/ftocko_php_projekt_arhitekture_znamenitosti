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
        <title>Dodavanje materijala</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxTipoviSelect.js"></script>
        <script src="javascript/ajaxZnamenitostiSelect.js"></script>
           
        
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
            <h2> Dodavanje materijala </h2>
            
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
        
        <div style="text-align:center;">
            
                    <h2 style="font-size:24px;"> Dodavanje materijala </h2>
            
                    <form name="obrazacMaterijal" id="obrazacMaterijal" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">
                
                         <fieldset style="width:50%;margin-left:auto;margin-right:auto;">
                             <div>
                             <label> Naziv materijala: </label>
                             </div>
                             <input type="text" name="nazivMaterijala">
                             <br> <br>
                             <div>
                             <label> Opis materijala: </label>
                             </div>
                             <input type="text" name="opisMaterijala">
                             <br> <br>
                             <div>
                             <label> Odaberite tip materijala: </label>
                             </div>
                             <select id="tipMaterijala" name="tipMaterijala"> </select>
                             <br> <br>
                             <div>
                             <label> Odaberite znamenitost: </label>
                             </div>
                             <select id="nazivZnam" name="nazivZnam"> </select>
                             <br> <br> <br>
                             <input type="file" name="datoteka" id="datoteka">
                             <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                             <br>
                             
                        </fieldset>
                     <br>
                    <input type="submit" class="submitPostavi" name="submitPostaviMaterijal" value="Postavi materijal">                  
                    </form>
            
         </div>
                    
        <br> <br>
        
        <div style="text-align:center;">
        <p> {$poruka} </p>
        </div>
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>
        </footer>

    </body>
</html>






