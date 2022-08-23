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
        <title>Upravljanje korisnicima</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxBlokiraniKorisnici.js"></script>
        <script src="javascript/ajaxKorisnici.js"></script>
  
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
            <h2> Upravljanje korisnicima </h2>
            
            <dl class="ListaStranica">
                
                 <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php"> Glavni zaslon </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
            </dl>
            

            
        </header>
        
        <div style="text-align: center;">
            
            <h2 style="color:black;"> Blokirani korisnici: </h2>
        
            <table border="3" id="blokiraniKorisnici" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                
                <thead style="color:black; background-color:white;"> 
                 <th> Ime </th>
                 <th> Prezime </th>
                 <th> Korisničko ime</th>
                 <th> E-mail</th>
                 <th> Status </th>
                 <th> Otključavanje računa </th>
                </thead>
                
            </table>
            <br>
            <select id="stranica"> {$opcijeBlokiraniKorisnici} </select>
        </div>
        
        <br> <br>
        
        <div style="text-align:center;">
            <h2 style="color:black;"> Neblokirani korisnici: </h2>
        </div>
        
        <div style="text-align:center;">
            
        <form action="{$smarty.server.PHP_SELF}" method="post">
        <select name="korisnik" id="korisnici" size="5"> </select>
        <br> <br>
        <input type="submit" name="blokirajKorime" value="Blokiraj korisnika" class="gumbBlokiraj">
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

