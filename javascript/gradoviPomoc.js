
brojac = 0;

function pomoc() {
    
    help = document.getElementById("pomoc");
    tekst = document.getElementById("text");

    brojac++;

    if (brojac == 1) {
        
        $("#text").css('font-size','13px');
        help.style.top = "33%";
        help.style.right = "80%";
        tekst.innerHTML = "Za lakši pronalazak željenog grada, imate mogućnost automatske pretrage prilikom unosa, po imenu istoga!";
    }

    if (brojac === 2) {
        
        $("#text").css('font-size','13px');
        help.style.top = "60%";
        help.style.right = "80%";
        tekst.innerHTML = "Imate mogućnost sortiranja po broju znamenitosti za prikaz gradove, koji imaju najviše znamenitosti!";

    }
    
     if (brojac === 3) {
        
        $("#text").css('font-size','13px');
        help.style.top = "30%";
        help.style.right = "3%";
        tekst.innerHTML = "Možete vidjeti zadnjih 10 dodanih znamenitosti po svakom gradu, klikom na gornju RSS ikonu!";

    }
    
    if (brojac === 4) {
        
        help.style.top = "32%";
        help.style.right = "90%";
        $("#text").css('font-size','24px');
        tekst.innerHTML = "POMOĆ!";
        
        brojac = 0;
    }

}

