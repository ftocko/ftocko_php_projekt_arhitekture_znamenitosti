function DohvatiSveKorisnike() {

    $.ajax({

        url: "sucelje_biblioteke/DohvatiKorisnike.php?param=select",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {
                
                var korisnicko_ime = json[i].korime;
                $("#korisnik").append("<option value="+korisnicko_ime+">"+korisnicko_ime+"</option>");

            }

        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){
    
    
    DohvatiSveKorisnike();
    
    
});

