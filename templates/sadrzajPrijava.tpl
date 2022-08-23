 <div id="pomoc" style="position: absolute; top: 25%; right: 10%; text-align: right; background:black; color: white;" onclick="pomoc();"> 
         <h2 id="text"> POMOĆ! </h2>
 </div>

<section class="SadrzajPrijava">  
            <br> <br> <br> <br>  <br> <br>
            <form id="prijava" method="post" action="{$smarty.server.PHP_SELF}">
                
                <label for="username"> Korisničko ime: </label>
                <input type="text" value="{$korisnicko_ime}" name="username" id="username" size="20">
                <br>
                <br> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="lozinka"> Lozinka:</label>
                <input type="password" name="lozinka" id="lozinka" size="20">
                <br> <br>
                &nbsp;&nbsp;&nbsp; <label for="zapamtiMe"> Zapamti me </label>
                <input type="radio" id="zapamtiMe" name="zapamtiMe">
                &nbsp;
                <a class="PosebanLink" href="PovratLozinke.php"> Zaboravili ste lozinku? </a>
                <br> <br>
                <input class="GumboviPrijava" type="submit" name="submit" id="submit" value="Prijava" style="height:50px;width:150px;">
                <input class="GumboviPrijava"type="reset" name="reset" id="reset" value="Inicijalizacija" style="height:50px;width:150px;">
                <br>
                <br>
                <p align="center"> Niste registrirani?&nbsp; <a class="PosebanLink" href="Registracija.php"> Registracija </a> </p>
            </form>
                <br>
                <p style="color:red;"> {$greska} </p>
                <br>
                <p style="color:green"> {$msg} </p>
 
            <br>


        </section>
