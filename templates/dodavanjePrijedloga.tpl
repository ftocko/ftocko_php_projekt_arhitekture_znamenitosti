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
        <title> Dodavanje prijedloga</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxGradoviSelect.js"> </script>
        <script src="javascript/validacijaDodavanjePrijedloga.js"> </script>
        
        
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
        
        $("#prijedlog").submit(function(){
            
            ValidirajPrijedloge();
        });
        
    });
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Dodavanje prijedloga </h2>
            
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
                 
                 {if $korisnik===null}
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 {/if}
                 
            </dl>
            
        </header>

        <br>
        <div style="text-align:center;">
            
        <form id="prijedlog" method="post" action="{$smarty.server.PHP_SELF}">
                
                <div>
                <label> Unesite ime i prezime:</label>
                </div>
                <input type="text" name="imePrezime" id="imePrezime" size="20">
                <br> <br>
                <div>
                <label> Unesite nadimak:</label>
                </div>
                <input type="text" name="nadimak" id="nadimak" size="20">
                <br> <br>
                <div>
                <label> Odaberite grad:</label>
                </div>
                <select id="grad" name="grad">  </select>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                <label> Unesite naziv znamenitosti:</label>
                </div>
                <input type="text" name="nazivZnam" id="nazivZnam" size="20">
                <br> <br>
                <div style="text-align:center;">
                <label> Unesite opis znamenitosti:</label>
                </div>
                <textarea name="opisZnam" id="opisZnam" rows="5" cols="52">  </textarea>
                <br> <br>
                <input class="GumbPrijedlog" type="submit" name="submit" id="submit" value="Dodaj prijedlog" style="height:50px;width:150px;">
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

