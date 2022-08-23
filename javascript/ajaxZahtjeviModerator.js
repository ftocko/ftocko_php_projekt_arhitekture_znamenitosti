
function ZahtjeviFunction(upit) {

    brojStranica = $("#stranica option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZahtjeveModerator.php?page=1&pages=" + brojStranica + "&upit="+upit+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var zahtjev_id = json[i].zahtjev_id;
                var korime = json[i].korime;
                var naziv_grada = json[i].naziv_grada;
                var naziv_znamenitosti = json[i].naziv_znamenitosti;
                var opis_znamenitosti = json[i].opis_znamenitosti;
                var godina_znamenitosti = json[i].godina_znamenitosti;
                var status = json[i].status;
                var prijedlog_id = json[i].prijedlog_id;
                
                if(status=="obrada"){
                    
                    $("#tablicaZahtjevi").append("<tr style='background-color:white;color:black;'> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> <td>"+prijedlog_id+"</td> <td> <a style='color:black;' href='Zahtjevi.php?kljuc=potvrdi&zahtjev_id="+zahtjev_id+"'> Potvrdi </a> / <a style='color:black;' href='Zahtjevi.php?kljuc=odbij&zahtjev_id="+zahtjev_id+"'> Odbij </a> </td> </tr>");
                }
                
                else if(status=="potvrdjeno"){
                    
                    $("#tablicaZahtjevi").append("<tr> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> <td>"+prijedlog_id+"</td> <td> Već potvrđeno! </td>  </tr>");
                }
                
                else if(status=="odbijeno"){
                    
                     $("#tablicaZahtjevi").append("<tr> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> <td>"+prijedlog_id+"</td> <td> Već odbijeno! </td>  </tr>");
                }

                

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

function ZahtjeviModeratorSelectionChanged(upit){
    
    $('#tablicaZahtjevi td').parent().remove();
    stranica = $("#stranica").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#stranica option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZahtjeveModerator.php?page="+stranica+"&pages=" + brojStranica + "&upit="+upit+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var zahtjev_id = json[i].zahtjev_id;
                var korime = json[i].korime;
                var naziv_grada = json[i].naziv_grada;
                var naziv_znamenitosti = json[i].naziv_znamenitosti;
                var opis_znamenitosti = json[i].opis_znamenitosti;
                var godina_znamenitosti = json[i].godina_znamenitosti;
                var status = json[i].status;
                var prijedlog_id = json[i].prijedlog_id;
                
                if(status=="obrada"){
                    
                     $("#tablicaZahtjevi").append("<tr style='background-color:white;color:black;'> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> <td>"+prijedlog_id+"</td> <td> <a style='color:black;' href='Zahtjevi.php?kljuc=potvrdi&zahtjev_id="+zahtjev_id+"'> Potvrdi </a> / <a style='color:black;' href='Zahtjevi.php?kljuc=odbij&zahtjev_id="+zahtjev_id+"'> Odbij </a> </td> </tr>");
                }
                
                else if(status=="potvrdjeno"){
                    
                    $("#tablicaZahtjevi").append("<tr> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> <td>"+prijedlog_id+"</td> <td> Već potvrđeno! </td>  </tr>");
                }
                
                else if(status=="odbijeno"){
                    
                     $("#tablicaZahtjevi").append("<tr> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> <td>"+prijedlog_id+"</td> <td> Već odbijeno! </td>  </tr>");
                }

                

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}




