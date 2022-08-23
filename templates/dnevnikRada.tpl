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
        <title>Dnevnik rada</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxDohvatiDnevnikKorisnik.js"></script>
        <script src="javascript/ajaxDohvatiKorisnikeSelect.js"></script>
        <script src="javascript/ajaxDohvatiRadnje.js"></script>
        
        
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
        
        user = "";
        user = '{$user}';
        radnja = "";
        radnja = '{$radnja}';
        username = "";
        username = '{$userName}';
        tipRadnje = "";
        tipRadnje = '{$tipRadnje}';
        
        if(user!==""){
            
            DohvatiDnevnik('{$user}');
        
            $("#page").change(function(){
            
            DohvatiDnevnikSelectionChanged('{$user}');
            
            });
            
        }
        
        else if (radnja!==""){
        
            DohvatiDnevnikSveRadnja('{$radnja}');
            
            $("#page").change(function(){
            
            DohvatiDnevnikSveRadnjaSelectionChanged('{$radnja}');
            
            });
        
        }
        
        else if(username!==""&&tipRadnje!==""){
        
            DohvatiDnevnikKorRadnja(username,tipRadnje);
            
            $("#page").change(function(){
            
            DohvatiDnevnikKorRadnjaSelectionChanged(username,tipRadnje);
            
            });
        
         }
        
        else{
            DohvatiDnevnikSve();
            
            $("#page").change(function(){
            
            DohvatiDnevnikSveSelectionChanged();
            
            });
        
        }
        
        
    });
    
    
    </script>
    
    <body>
        <header>
            <h2> Dnevnik rada </h2>
            
            <dl class="ListaStranica">
                
                 <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php"> Glavni zaslon </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
            </dl>
            

            
        </header>
                 
        <br>
        
        <div style="text-align:center;">
            
            <form action="" method="post" id="formaDnevnik">
                
                <div> <label> Korisnik: </label> </div>
                <select name="korisnik" id="korisnik"> </select>

                <br> <br>
                
                <div> <label> Tip radnje: </label> </div>
                <select name="radnja" id="radnja"> </select>
                
                <br> <br>
                
                <input type="submit" name="submitKorisnik" id="submitKorisnik" value="Pretraži dnevnik po korisniku">
                <input type="submit" name="submitRadnja" id="submitRadnja" value="Pretraži dnevnik po tipu radnje">
                <input type="submit" name="submitKorRadnja" id="submitKorRadnja" value="Pretraži dnevnik po tipu radnje i korisniku">
                <input type="submit" name="submitSve" id="submitSve" value="Pretraži cijeli dnevnik">
                
            </form>
            
            <br>
            
            <h2 style="color:black;"> Aktivnosti iz dnevnika </h2>
        
            <table border="3" id="dnevnik" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Id </th>
                 <th> Korisnik </th>
                 <th> Tip radnje </th>
                 <th> Datum i vrijeme </th>
                 <th> Radnja </th>
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



