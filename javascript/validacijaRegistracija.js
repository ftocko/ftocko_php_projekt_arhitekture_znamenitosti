


$(document).ready(function () {


    $('#submit').click(function (e) {

        Provjera();

    });

});




function Provjera() {


    var vrati = false;

    var greska = "";
    var korisnickoIme = "";
    var lozinka = "";
    var ponovljenaLozinka = "";

    korisnickoIme = document.registracijaObrazac.korime.value;
    lozinka = document.registracijaObrazac.lozinka.value;
    ponovljenaLozinka = document.registracijaObrazac.ponovljenaLozinka.value;
    e_mail = document.registracijaObrazac.email.value;

    if (korisnickoIme.length < 5 || korisnickoIme.length > 10) {

        greska = greska + " " + "Korisničko ime ne zadovoljava potrebni broj znakova (5-10)!";

    }


    if (lozinka !== ponovljenaLozinka) {

        greska = greska + " " + "Unesene lozinke nisu iste!";

    }

    predlozak = new RegExp(".+[@]+.+[.].+");

    ispravno = predlozak.test(e_mail);

    if (ispravno === false) {
        greska = greska + " " + "Niste unijeli validnu e-mail adresu!";
    }

    if (korisnickoIme === "" || lozinka === "" || ponovljenaLozinka === "") {

        greska = greska + " " + "Korisničko ime, lozinka i potvrda lozinke su obavezna polja!";

    }

    predlozakBroj = new RegExp("(?=.*[0-9])");

    ispravnoBroj = predlozakBroj.test(lozinka);

    if (ispravnoBroj === false) {
        greska = greska + " " + "Lozinka ne sadrži barem jedan broj!";
    }

    predlozakVelikoSlovo = new RegExp("(?=.*[A-Z])");

    ispravnoVelikoSlovo = predlozakVelikoSlovo.test(lozinka);

    if (ispravnoVelikoSlovo === false) {
        greska = greska + " " + "Lozinka ne sadrži barem jedno veliko slovo!";
    }

    if (greska !== "") {

        alert(greska);
        event.preventDefault();

    }



}
















