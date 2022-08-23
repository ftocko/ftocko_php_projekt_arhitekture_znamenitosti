
 <div id="pomoc" style="position: absolute; top: 25%; right: 10%; text-align: right; background:black; color: white;" onclick="pomoc();"> 
         <h2 id="text"> POMOĆ! </h2>
 </div>
<section class="SadrzajRegistracija">  
            <br> <br> <br>
            <form id="registracija" name="registracijaObrazac" method="post" action="{$smarty.server.PHP_SELF}">
                <label for="ime"> Unesite ime: </label>
                <input type="text" name="ime" id="ime" size="20">
                <br>
                <br> 
                <label for="prezime"> Unesite prezime:</label>
                <input type="text" name="prezime" id="prezime" size="20">
                <br> <br>
                <label for="korime"> Unesite korisničko ime:</label>
                <input type="text" name="korime" id="korime" size="20">
                <br> <br>
                <label for="lozinka"> Unesite lozinku:</label>
                <input type="password" name="lozinka" id="lozinka" size="20">
                <br> <br>
                <label for="ponovljenaLozinka"> Ponovite lozinku:</label>
                <input type="password" name="ponovljenaLozinka" id="ponovljenaLozinka" size="20">
                <br> <br>
                <label for="email"> Unesite E-mail:</label>
                <input type="text" name="email" id="email" size="20">
                <br> <br>
                
                
                <input class="GumboviRegistracija" type="submit" name="submitRegister" id="submit" value="Registracija" style="height:50px;width:150px;">
                <input class="GumboviRegistracija"type="reset" name="reset" id="reset" value="Inicijalizacija" style="height:50px;width:150px;">
                <br>
                <div style=text-align:left;" class="g-recaptcha" data-sitekey="6LelrxcbAAAAAEAFzHHyjC2_JeZ6--FRVojMRhTE"></div>
            </form>
            <br> <br>
                
            <p style="color:red;"> {$greska} </p>
            <p style="color:green;"> {$message} </p>
                  
        </section>
            
                
                
                
                