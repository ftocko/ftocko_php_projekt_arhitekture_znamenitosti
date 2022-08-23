
function StatistikaFunction() {
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuGradova.php?page=1&pages="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_grada = json[i].naziv_grada;
                var broj_znamenitosti = json[i].broj_znamenitosti;

                $("#statistikaGradova").append("<tr> <td>" + naziv_grada + "</td> <td>" + broj_znamenitosti + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

$(document).ready(function () {

    StatistikaFunction();
    
    $("#page").change(function () {

        $('#statistikaGradova td').parent().remove();
        
        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;
        
        $.ajax({

            url: "sucelje_biblioteke/DohvatiStatistikuGradova.php?page="+stranica+"&pages="+brojStranica+"",
            type: 'GET',
            data: {
                page:stranica,
                numPages: brojStranica
            },
            dataType: 'json',
            success: function (json) {


                for (i = 0; i < json.length; i++) {

                    var naziv_grada = json[i].naziv_grada;
                    var broj_znamenitosti = json[i].broj_znamenitosti;
                    $("#statistikaGradova").append("<tr> <td>" + naziv_grada + "</td> <td>" + broj_znamenitosti + "</td> </tr>");
                }
            },
            error: function (xhr, status, error) {
                alert("Pogreška: " + error.responseText);
            }


        });
    });
    
    
    $("#gumbBrojZnam").click(function () {
        
        $('#statistikaGradova td').parent().remove();
        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;

        $.ajax({

            url: "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/sucelje_biblioteke/DohvatiStatistikuGradova.php?sort=brojZnamenitosti&page="+stranica+"&pages="+brojStranica+"",
            type: 'GET',
            dataType: 'json',
            success: function (json) {

                for (i = 0; i < json.length; i++) {

                    var naziv_grada = json[i].naziv_grada;
                    var broj_znamenitosti = json[i].broj_znamenitosti;
                    $("#statistikaGradova").append("<tr> <td>" + naziv_grada + "</td> <td>" + broj_znamenitosti + "</td> </tr>");
                }
            },
            error: function (xhr, status, error) {
                alert("Pogreška: " + error.responseText);
            }


        });
    });
});
















