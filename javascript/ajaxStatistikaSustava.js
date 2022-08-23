function StatistikaFunction() {

    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustava.php?page=1&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}

function StatistikaFunctionSelectionChanged() {

    $('#statistikaSustava td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustava.php?page=" + stranica + "&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

function StatistikaFunctionUser(user){
    
    $('#statistikaSustava td').parent().remove();
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustava.php?page=1&pages=" + brojStranica + "&user="+user+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function StatistikaFunctionUserSelectionChanged(user) {

    $('#statistikaSustava td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustava.php?page="+stranica+"&pages=" + brojStranica + "&user="+user+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

    

}

function StatistikaFunctionVrijeme(vrijemeOd,vrijemeDo){
    
    $('#statistikaSustava td').parent().remove();
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustava.php?page=1&pages=" + brojStranica + "&vrijemeOd="+vrijemeOd+"&vrijemeDo="+vrijemeDo+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function StatistikaFunctionVrijemeSelectionChanged(vrijemeOd,vrijemeDo) {

    $('#statistikaSustava td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustava.php?page="+stranica+"&pages=" + brojStranica + "&vrijemeOd="+vrijemeOd+"&vrijemeDo="+vrijemeDo+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

    

}

function StatistikaFunctionVrijemeKorisnik(timeOd,timeDo,korisnik){
    
    $('#statistikaSustava td').parent().remove();
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustavaVrijemeKorisnik.php?page=1&pages=" + brojStranica + "&vrijemeOd="+timeOd+"&vrijemeDo="+timeDo+"&user="+korisnik+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function StatistikaFunctionVrijemeKorisnikSelectionChanged(timeOd,timeDo,korisnik) {

    $('#statistikaSustava td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiStatistikuSustavaVrijemeKorisnik.php?page="+stranica+"&pages=" + brojStranica + "&vrijemeOd="+timeOd+"&vrijemeDo="+timeDo+"&user="+korisnik+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var stranica = json[i].stranica;
                var broj_pristupa = json[i].broj_pristupa;
                

                $("#statistikaSustava").append("<tr> <td>" + stranica + "</td> <td>" + broj_pristupa + "</td> </tr>");

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

    

}



