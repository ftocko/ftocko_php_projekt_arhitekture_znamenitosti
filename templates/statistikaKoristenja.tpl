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
        <title>Statistika korištenja</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/ajaxStatistikaSustava.js"></script>
        <script src="javascript/ajaxKorisniciStatistika.js"></script>
        <script src="javascript/ajaxDohvatiVremenaRadnji.js"></script>
        
        
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
        vrijemeOd = "";
        vrijemeDo = "";
        timeOd = "";
        timeDo = "";
        $userName = "";
        
        user = '{$user}';
        vrijemeOd = '{$vrijemeOd}';
        vrijemeDo = '{$vrijemeDo}';
        
        timeOd = '{$timeOd}';
        timeDo = '{$timeDo}';
        userName = '{$userName}';
        
        if(user!==""){
            
            alert("Statistika za korisnika:"+user+"");
            
            StatistikaFunctionUser('{$user}');
        
            $("#page").change(function(){
        
            StatistikaFunctionUserSelectionChanged('{$user}');
        
        });
            
        }    
        
        else if(vrijemeOd!==""&&vrijemeDo!==""){
            
            alert("Statistika za vremensko razdoblje: "+vrijemeOd+"------>"+vrijemeDo+"");
            
            StatistikaFunctionVrijeme(vrijemeOd,vrijemeDo);
            
            $("#page").change(function(){
        
            StatistikaFunctionVrijemeSelectionChanged(vrijemeOd,vrijemeDo);
        
        });
            
        }
        
        else if(timeOd!==""&&timeDo!==""&&userName!==""){
            
            alert("Statistika za vremensko razdoblje: "+timeOd+"------>"+timeDo+"i korisnika:"+userName+"");
            
            StatistikaFunctionVrijemeKorisnikSelectionChanged(timeOd,timeDo,userName);
            
             $("#page").change(function(){
        
            StatistikaFunctionVrijemeKorisnikSelectionChanged(timeOd,timeDo,userName);
        
        });
            
            
            
        }
        
        
        
        else{
            
            StatistikaFunction();
        
            $("#page").change(function(){
        
            StatistikaFunctionSelectionChanged();
        
        });
            
        }
        
        
        
    });
    
    
    
    
    
    </script>
    
    <body>
        <header>
            <h2> Statistika korištenja </h2>
            
            <dl class="ListaStranica">
                
                 <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php"> Glavni zaslon </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 
            </dl>
            

            
        </header>
                 
        <br>
        
        <div style="text-align: center;">
            
            <h2 style="color:black;"> Statistika korištenja sustava pristupa stranicama </h2>
            
                
            
            <div style="text-align:center;">
                
                <form action="" method="post">
                
                    <div> <label> Korisnik: </label> </div>
                    <select id="userStatistika" name="userStatistika">  </select>
            
                    <br> <br>
            
                    <div> <label> Vrijeme od: </label> </div>
                    <select id="vrijemeOd" name="vrijemeOd">  </select>
            
                    <br><br>
            
                    <div> <label> Vrijeme do: </label> </div>
                    <select id="vrijemeDo" name="vrijemeDo">  </select>
           
            
                    <br> <br>
                
                    <input type="submit" name="submitUser" id="submitUser" value="Pretraži statistiku po korisniku">
                    <input type="submit" name="submitVrijeme" id="submitVrijeme" value="Pretraži statistiku po vremenskom razdoblju">
                    <input type="submit" name="submitVrijemeKor" id="submitVrijemeKor" value="Pretraži statistiku po vremenskom razdoblju i korisniku">
                    <input type="submit" name="submitAll" id="submitAll" value="Pretraži cijelu statistiku">
            
                </form>
           
            </div>
            
            <br> <br> <br>
        
            <table border="3" id="statistikaSustava" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Stranica </th>
                 <th> Broj pristupa </th>
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




