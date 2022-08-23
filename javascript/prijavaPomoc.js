
brojac = 0;

function pomoc() {
    
    help = document.getElementById("pomoc");
    tekst = document.getElementById("text");

    brojac++;

    if (brojac == 1) {
        
        $("#text").css('font-size','13px');
        help.style.top = "43%";
        help.style.right = "3%";
        tekst.innerHTML = "Pripazite da unesete ispravne korisničke podatke jer možete biti blokirani!";
    }

    if (brojac === 2) {
        
        $("#text").css('font-size','13px');
        help.style.top = "52%";
        help.style.right = "3%";
        tekst.innerHTML = "Odaberite opciju 'Zapamti me', kako bi se spremilo Vaše korisničko ime!";

    }
    
    if (brojac === 3) {
        
        help.style.top = "25%";
        help.style.right = "10%";
        $("#text").css('font-size','24px');
        tekst.innerHTML = "POMOĆ!";
        
        brojac = 0;
    }

}