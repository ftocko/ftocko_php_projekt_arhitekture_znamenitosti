

function AjaxFunction(upit) {
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiKorisnikeZahtjeve.php?page=1&pages="+brojStranica+"&upit="+upit+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            
            $('#tablicaKorisnikZahtjev td').parent().remove();

            for (i = 0; i < json.length; i++) {

                var korisnicko_ime = json[i].korisnicko_ime;
                var broj_zahtjeva = json[i].broj_zahtjeva;
                var status = json[i].status_zahtjev;

                if(status==1){
                   $("#tablicaKorisnikZahtjev").append("<tr> <td>" + korisnicko_ime + "</td> <td>" + broj_zahtjeva + "</td> <td>"+status+"</td> <td> <a href='Zahtjevi.php?param=blokiraj&korime="+korisnicko_ime+"' style='color:black;'> Blokiraj </a> </td> </tr>");
                }
                
                else if (status==0){
                    $("#tablicaKorisnikZahtjev").append("<tr> <td>" + korisnicko_ime + "</td> <td>" + broj_zahtjeva + "</td> <td>"+status+"</td> <td> <a href='Zahtjevi.php?param=deblokiraj&korime="+korisnicko_ime+"' style='color:black;'> Deblokiraj </a> </td> </tr>");
                }
                

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

function AjaxSelectionChanged(upit){
    
    $('#tablicaKorisnikZahtjev td').parent().remove();
        
    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiKorisnikeZahtjeve.php?page="+stranica+"&pages="+brojStranica+"&upit="+upit+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            
            $('#tablicaKorisnikZahtjev td').remove();

            for (i = 0; i < json.length; i++) {

                var korisnicko_ime = json[i].korisnicko_ime;
                var broj_zahtjeva = json[i].broj_zahtjeva;
                var status = json[i].status_zahtjev;

                if(status==1){
                   $("#tablicaKorisnikZahtjev").append("<tr> <td>" + korisnicko_ime + "</td> <td>" + broj_zahtjeva + "</td> <td>"+status+"</td> <td> <a href='Zahtjevi.php?param=blokiraj&korime="+korisnicko_ime+"' style='color:black;'> Blokiraj </a> </td> </tr>");
                }
                
                else if (status==0){
                    $("#tablicaKorisnikZahtjev").append("<tr> <td>" + korisnicko_ime + "</td> <td>" + broj_zahtjeva + "</td> <td>"+status+"</td> <td> <a href='Zahtjevi.php?param=deblokiraj&korime="+korisnicko_ime+"' style='color:black;'> Deblokiraj </a> </td> </tr>");
                }
                

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}




