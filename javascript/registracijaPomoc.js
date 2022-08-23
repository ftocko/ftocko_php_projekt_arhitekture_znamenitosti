brojac = 0;

function pomoc() {
    
    help = document.getElementById("pomoc");
    tekst = document.getElementById("text");

    brojac++;
    
    if (brojac == 1) {
        
        $("#text").css('font-size','13px');
        help.style.top = "30%";
        help.style.right = "3%";
        tekst.innerHTML = "Početno slovo Vašeg imena mora biti veliko!";
    }
    
    if (brojac == 2) {
        
        $("#text").css('font-size','13px');
        help.style.top = "35%";
        help.style.right = "3%";
        tekst.innerHTML = "Početno slovo Vašeg prezimena mora biti veliko!";
    }

    if (brojac == 3) {
        
        $("#text").css('font-size','13px');
        help.style.top = "42%";
        help.style.right = "3%";
        tekst.innerHTML = "Korisničko ime mora imati 5-10 znakova i ne smije sadržavati brojeve!";
    }

    if (brojac === 4) {
        
        $("#text").css('font-size','13px');
        help.style.top = "48%";
        help.style.right = "3%";
        tekst.innerHTML = "Lozinka mora imati 8-10 znakova i mora sadržavati barem jedno veliko slovo i broj!";

    }
    
    if (brojac === 5) {
        
        $("#text").css('font-size','13px');
        help.style.top = "55%";
        help.style.right = "3%";
        tekst.innerHTML = "Ponovljena lozinka se mora podudarati s originalno unešenom lozinkom!";

    }
    
    if (brojac === 6) {
        
        $("#text").css('font-size','13px');
        help.style.top = "62%";
        help.style.right = "3%";
        tekst.innerHTML = "Pripazite da unesete validan E-mail račun s kojim se još niste registrirali!";

    }
    
    if (brojac === 7) {
        
        help.style.top = "25%";
        help.style.right = "10%";
        $("#text").css('font-size','24px');
        tekst.innerHTML = "POMOĆ!";
        
        brojac = 0;
    }

}


