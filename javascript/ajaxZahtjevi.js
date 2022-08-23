
function ZahtjevFunction() {

    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZahtjeve.php?page=1&pages=" + brojStranica + "",
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

                $("#tablicaZahtjeva").append("<tr> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

$(document).ready(function () {

    ZahtjevFunction();

    $("#page").change(function () {

        $('#tablicaZahtjeva td').parent().remove();

        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;

        $.ajax({

            url: "sucelje_biblioteke/DohvatiZahtjeve.php?page=" + stranica + "&pages=" + brojStranica + "",
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
                    var status = json[i].status


                    $("#tablicaZahtjeva").append("<tr> <td>" + zahtjev_id + "</td> <td>" + korime + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + godina_znamenitosti + "</td> <td>" + status + "</td> </tr>");

                }
            },

            error: function (xhr, status, error) {
                alert("Pogreška: " + error.responseText);
            }


        });




    });
});



