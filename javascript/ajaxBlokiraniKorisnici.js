function DohvatiBlokiraneKorisnike() {
    
    brojStranica = $("#stranica option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiBlokiraneKorisnike.php?page=1&pages="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var ime = json[i].ime;
                var prezime = json[i].prezime;
                var korisnicko_ime = json[i].korime;
                var email = json[i].email;
                var status = json[i].status;

                $("#blokiraniKorisnici").append("<tr> <td>"+ime+"</td> <td>"+prezime+"</td> <td>"+korisnicko_ime+"</td> <td>"+email+"</td> <td>"+status+"</td> <td> <a href=UpravljanjeKorisnicima.php?korime="+korisnicko_ime+"> Otključaj </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){ 
    
    DohvatiBlokiraneKorisnike();
    
    $("#stranica").change(function () {

        $('#blokiraniKorisnici td').parent().remove();
        
        stranica = $("#stranica").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#stranica option").length;
        
        
        $.ajax({

        url: "sucelje_biblioteke/DohvatiBlokiraneKorisnike.php?page="+stranica+"&pages="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var ime = json[i].ime;
                var prezime = json[i].prezime;
                var korisnicko_ime = json[i].korime;
                var email = json[i].email;
                var status = json[i].status;

                $("#blokiraniKorisnici").append("<tr> <td>"+ime+"</td> <td>"+prezime+"</td> <td>"+korisnicko_ime+"</td> <td>"+email+"</td> <td>"+status+"</td> <td> <a href=UpravljanjeKorisnicima.php?korime="+korisnicko_ime+"> Otključaj </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
        
   
    });
    
    
}); 
    
    



