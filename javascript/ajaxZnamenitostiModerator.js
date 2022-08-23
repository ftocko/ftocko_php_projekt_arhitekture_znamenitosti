function GetZnamenitostiFunction(upit) {
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZnamenitostiModerator.php?page=1&pages="+brojStranica+"&upit="+upit+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            
            $('#tablicaZnamenitosti td').remove();

            for (i = 0; i < json.length; i++) {

                var id = json[i].id;
                var zahtjev_id =  json[i].zahtjev_id;
                var moderator = json[i].moderator;
                var predlozio = json[i].predlozio;
                var naziv = json[i].naziv;
                var godina = json[i].godina;
                var datum_vrijeme = json[i].datum_vrijeme;
                var opis = json[i].opis;
                
                $("#tablicaZnamenitosti").append("<tr> <td>" + id + "</td> <td>" + zahtjev_id + "</td> <td>" + moderator + "</td> <td>" + predlozio + "</td> <td>" + naziv + "</td> <td>" + godina + "</td> <td>" + datum_vrijeme + "</td> <td>" + opis + "</td> <td> <a href='AzuriranjeZnamenitosti.php?id="+id+"' style='color:white;'> Ažuriraj </a> </td> </tr>");
               

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

function GetZnamenitostiSelectionChanged(upit){
    
    $('#tablicaZnamenitosti td').parent().remove();
    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZnamenitostiModerator.php?page="+stranica+"&pages="+brojStranica+"&upit="+upit+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            
            $('#tablicaZnamenitosti td').remove();

            for (i = 0; i < json.length; i++) {

                var id = json[i].id;
                var zahtjev_id =  json[i].zahtjev_id;
                var moderator = json[i].moderator;
                var predlozio = json[i].predlozio;
                var naziv = json[i].naziv;
                var godina = json[i].godina;
                var datum_vrijeme = json[i].datum_vrijeme;
                var opis = json[i].opis;
                
                $("#tablicaZnamenitosti").append("<tr> <td>" + id + "</td> <td>" + zahtjev_id + "</td> <td>" + moderator + "</td> <td>" + predlozio + "</td> <td>" + naziv + "</td> <td>" + godina + "</td> <td>" + datum_vrijeme + "</td> <td>" + opis + "</td> <td> <a href='AzuriranjeZnamenitosti.php?id="+id+"' style='color:white;'> Ažuriraj </a> </td> </tr>");
               

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
    
    
}


