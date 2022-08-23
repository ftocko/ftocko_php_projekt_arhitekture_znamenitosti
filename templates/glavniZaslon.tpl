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
        <title>Arhitektura u Hrvatskoj</title>
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
    
    <body style="background-color:white;">
        <header>
            <h2> Arhitektura u Hrvatskoj </h2>
            
            <dl class="ListaStranica">
                
                 {if $uloga==="1"}
                 <dt class="ElementListe"> <a class="element" href="UpravljanjeKorisnicima.php"> Upravljanje korisnicima </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="UpravljanjeKonfiguracijom.php"> Upravljanje konfiguracijom </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="DnevnikRada.php"> Dnevnik rada </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="StatistikaKoristenja.php"> Statistika korištenja </a> </dt>
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
                 {/if}
            </dl>
          
       
        </header>
            
            
        
        <div class="Sadrzaj" style="text-align:center;">
            <h2 style="color:black;font-style:italic;font-size:24px;text-transform: uppercase;text-decoration:underline;"> Dobrodošli u Web aplikaciju o arhitekturi! </h2>
            
            <img src="https://images.unsplash.com/photo-1511818966892-d7d671e672a2?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YXJjaGl0ZWN0dXJlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&w=1000&q=80" style="width:100%;" height="690">

        </div>
        
         <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>
