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

br = 0;

function PromijeniDizajn() {

    let dizajn = document.getElementById("design");

    br++;

    if (br % 2 !== 0) {

        dizajn.href = "CSS/ftocko_darkmode.css";
        putanjaDizajn = "CSS/ftocko_darkmode.css";
        PostaviKolacic("Dizajn", putanjaDizajn);

    } else {

        dizajn.href = "CSS/ftocko.css";
        putanjaDizajn = "CSS/ftocko.css";
        PostaviKolacic("Dizajn", putanjaDizajn);
    }



}

brojacDisleksije = 0;

function PrilagodbaDisleksije() {
    
    let dizajn = document.getElementById("design");

    brojacDisleksije++;

    if (brojacDisleksije % 2 !== 0) {

        
        dizajn.href = "CSS/ftocko_accessibility.css";
        putanjaDizajn = "CSS/ftocko_accessibility.css";
        PostaviKolacic("Dizajn", putanjaDizajn);

    }
    
    else{
        
        dizajn.href = "CSS/ftocko.css";
        putanjaDizajn = "CSS/ftocko.css";
        PostaviKolacic("Dizajn", putanjaDizajn);
    }

}

window.onload = function () {


    if (DohvatiKolacic("Dizajn")) {

        $trazeniDizajn = DohvatiKolacic("Dizajn");
        dizajn = document.getElementById("design");
        dizajn.href = $trazeniDizajn;

    }

    slika = document.getElementById("designLogo");

    slika.addEventListener("click", PromijeniDizajn);

};









