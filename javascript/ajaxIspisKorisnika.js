
function IspisFunction() {

    brojStranica = $("#page option").length;

    $.ajax({

        url: "../sucelje_biblioteke/DohvatiIspisKorisnika.php?page=1&pages=" + brojStranica +"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

               var korisnicko_ime = json[i].korisnicko_ime;
                var lozinka = json[i].lozinka;
                var naziv_uloga = json[i].naziv_uloga;
                var ime = json[i].ime;
                var prezime = json[i].prezime;
                var email = json[i].email;
                
                
                $("#users").append("<tr> <td>" + ime + "</td> <td>" + prezime + "</td> <td>" + korisnicko_ime + "</td> <td>" + naziv_uloga + "</td> <td>" + lozinka + "</td> <td>" + email + "</td> </tr>");
               

                

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

function IspisFunctionSelectionChanged(){
    
    $('#users td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;
    
      $.ajax({

        url: "../sucelje_biblioteke/DohvatiIspisKorisnika.php?page="+stranica+"&pages=" + brojStranica +"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var korisnicko_ime = json[i].korisnicko_ime;
                var lozinka = json[i].lozinka;
                var naziv_uloga = json[i].naziv_uloga;
                var ime = json[i].ime;
                var prezime = json[i].prezime;
                var email = json[i].email;
                
                
                $("#users").append("<tr> <td>" + ime + "</td> <td>" + prezime + "</td> <td>" + korisnicko_ime + "</td> <td>" + naziv_uloga + "</td> <td>" + lozinka + "</td> <td>" + email + "</td> </tr>");
               

                

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

    
    
}

$(document).ready(function(){
    
    IspisFunction();
    
    $("#page").change(function(){
        
        IspisFunctionSelectionChanged();
        
    });
    
});


