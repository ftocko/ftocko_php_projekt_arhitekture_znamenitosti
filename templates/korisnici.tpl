<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link id="dizajn" rel="stylesheet" href="../CSS/ftocko.css">
        <title>Korisnici</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../javascript/ajaxIspisKorisnika.js"></script>
        
        
    </head>
    
    
    <body>
        
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
            $trazeniDizajn = "../"+$trazeniDizajn+"";
            dizajn.href = $trazeniDizajn;
    } 
    
    
    
    
    
    
    
    </script>
    
        <header>
            <h2> Ispis korisnika </h2>
            
            <dl class="ListaStranica">
                
                 <dt class="ElementListe"> <a class="element" href="../index.php"> Početni zaslon </a> </dt>
                 
            </dl>
            

            
        </header>
                 
        <br> <br>
        
        <div style="text-align: center;">
            
            <h2 style="color:black;"> Ispis korisnika </h2>
        
            <table border="3" id="users" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Ime </th>
                 <th> Prezime </th>
                 <th> Korisničko ime </th>
                 <th> Tip korisnika </th>
                 <th> Lozinka </th>
                 <th> Email </th>
                </thead>
            </table>
        </div>
        
        <br> <br>
        
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="page" name="page[]"> {$opcije} </select>
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
