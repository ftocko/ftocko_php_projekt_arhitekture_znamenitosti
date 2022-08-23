function DohvatiPrijedlogeFunction() {
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiSvePrijedloge.php?page=1&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var prijedlog_id = json[i].prijedlog_id;
                var naziv_grada = json[i].naziv_grada;
                var naziv_znamenitosti = json[i].naziv_znamenitosti;
                var opis_znamenitosti = json[i].opis_znamenitosti;
                var nadimak = json[i].nadimak;
                var ime_prezime = json[i].ime_prezime;

                $("#popisPrijedloga").append("<tr> <td>" + prijedlog_id + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + nadimak + "</td> <td>" + ime_prezime + "</td> <td> <a style='color:black;' href='DodavanjeZahtjeva.php?prijedlog="+prijedlog_id+"'> Zahtjev </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){
    
    DohvatiPrijedlogeFunction();
    
    $("#page").change(function () {

        $('#popisPrijedloga td').parent().remove();

        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;

        $.ajax({

        url: "sucelje_biblioteke/DohvatiSvePrijedloge.php?page="+stranica+"&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var prijedlog_id = json[i].prijedlog_id;
                var naziv_grada = json[i].naziv_grada;
                var naziv_znamenitosti = json[i].naziv_znamenitosti;
                var opis_znamenitosti = json[i].opis_znamenitosti;
                var nadimak = json[i].nadimak;
                var ime_prezime = json[i].ime_prezime;

                $("#popisPrijedloga").append("<tr> <td>" + prijedlog_id + "</td> <td>" + naziv_grada + "</td> <td>" + naziv_znamenitosti + "</td> <td>" + opis_znamenitosti + "</td> <td>" + nadimak + "</td> <td>" + ime_prezime + "</td> <td> <a style='color:black;' href='DodavanjeZahtjeva.php?prijedlog="+prijedlog_id+"'> Zahtjev </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });




    });
    
    
});


