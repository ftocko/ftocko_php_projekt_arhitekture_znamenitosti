

        <div class="Sadrzaj" style="margin-top:10%;">
            
            <form method="post" action="{$smarty.server.PHP_SELF}">
                <label for="korime"> Unesite korisničko ime: </label>
                <input type="text" name="korime" id="korime">
                <br>
                <br>
                <label for="korime"> Unesite email: </label>
                <input type="email" name="email" id="email">
                <br> <br>
                <input onclick="alert('Vaša lozinka je uspješno promijenjena i poslana na E-mail!');" type="submit" name="submit" id="submitLozinka" value="Nova lozinka">
                <br> <br>
                
            </form>

        </div>

        <footer style="bottom:0;position:absolute;">
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>
