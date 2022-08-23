function DohvatiSveKorisnike() {

    $.ajax({

        url: "sucelje_biblioteke/DohvatiKorisnike.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {
                
                var korisnicko_ime = json[i].korime;
                $("#korisnici").append("<option>"+korisnicko_ime+"</option>");

            }

        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

window.onload = DohvatiSveKorisnike();


