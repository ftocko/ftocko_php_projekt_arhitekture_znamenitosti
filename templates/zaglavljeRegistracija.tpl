<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="CSS/ftocko.css">
        <title>Registracija</title>
    </head>
    <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="javascript/validacijaRegistracija.js"> </script>
    <script src="javascript/registracijaPomoc.js"> </script>
    
    
 <script>
        
    function DohvatiKolacic(kljuc) {
    var keyValue = document.cookie.match('(^|;) ?' + kljuc + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] :
            null;
}

function PostaviKolacic(kljuc, vrijednost) {

    let expires = new Date();
    expires.setTime(expires.getTime() + {$trajanjeKolacica} * 24 * 60 * 60 * 1000);

    document.cookie = kljuc + '=' + vrijednost + "; expires=" + expires.toGMTString() + ";";
}

if (DohvatiKolacic("Dizajn")) {

    $trazeniDizajn = DohvatiKolacic("Dizajn");
    dizajn = document.getElementById("dizajn");
    dizajn.href = $trazeniDizajn;
}

function ProvjeraUvjeta() {

    if (!DohvatiKolacic("UvjetiKoristenja")) {

        var rezultat = confirm("Prihvaćate li uvjete korištenja? ");

        if (rezultat) {

            vrijeme = new Date();
            vrijemeMonth = vrijeme.getMonth() + 1;

            datumTimestamp = new Date();
            timestamp = Math.round(datumTimestamp.getTime() / 1000);
            
            PostaviKolacic("VrijemePrihvacanja", timestamp);
            PostaviKolacic("UvjetiKoristenja", "Prihvaćeni");


            alert("Uvjeti korištenja su prihvaćeni!");

        } else {
            alert("Prihvaćanje uvjeta korištenja je obavezno!");
            location.reload();
        }
    }
    

}

function BrisanjeKolacicaUvjeta(){
    
    document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';
}

{if $obrisi == "true"}
BrisanjeKolacicaUvjeta();
{/if}
    
ProvjeraUvjeta();
    
{if $resetirani == 1}
    
document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';
window.location.href = "Registracija.php?unreset=unreset";

{/if}
    
    
        
</script>
    <body class="BodyRegistracija">
        <header class="DizajnHeader">
            <h2> Registracija </h2>
            <dl class="ListaStranica">
                <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Prijava.php">Prijava </a> </dt>
                <dt class="ElementListe"> <a class="element" href="O_autoru.php">O autoru </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Dokumentacija.php">Dokumentacija </a> </dt>
            </dl>

        </header>
