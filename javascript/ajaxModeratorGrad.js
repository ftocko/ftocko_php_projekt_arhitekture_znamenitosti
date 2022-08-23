
function DohvatiKorisnike(){
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiKorisnike.php?podatak=moderatori",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                $("#Korisnici").append("<option>"+json[i].korime+"</option>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function DohvatiGradove(){
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiGradoveSelect.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                $("#Gradovi").append("<option>"+json[i].naziv_grada+"</option>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function DohvatiUpravljanja(){
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiUpravljanja.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                $("#tablicaUpravljanja").append("<tr> <td>"+json[i].korisnicko_ime+"</td> <td>"+json[i].naziv_grada+"</td> <td> <a style='color:white;' href=DodjelaModeratora.php?username="+json[i].korisnicko_ime+"&town="+json[i].naziv_grada+"> Oduzmi </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}


$(document).ready(function(){
    
    DohvatiKorisnike();
    DohvatiGradove();
    DohvatiUpravljanja();
    
});


