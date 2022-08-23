function DohvatiDnevnik(user) {

    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnik.php?page=1&pages=" + brojStranica + "&user=" + user + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

function DohvatiDnevnikSve() {

    brojStranica = $("#page option").length;
    $('#dnevnik td').parent().remove();

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnikSve.php?page=1&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

function DohvatiDnevnikSveSelectionChanged(){
    
    $('#dnevnik td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnikSve.php?page="+stranica+"&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function DohvatiDnevnikSelectionChanged(user) {

    $('#dnevnik td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnik.php?page="+stranica+"&pages=" + brojStranica + "&user=" + user + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

function DohvatiDnevnikSveRadnja(radnja){
    
    brojStranica = $("#page option").length;
    $('#dnevnik td').parent().remove();

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnikRadnja.php?page=1&pages=" + brojStranica + "&radnja="+radnja+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function DohvatiDnevnikSveRadnjaSelectionChanged(radnja){
    
    $('#dnevnik td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnikRadnja.php?page="+stranica+"&pages=" + brojStranica + "&radnja="+radnja+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function DohvatiDnevnikKorRadnja(korisnik,radnja){
    
    brojStranica = $("#page option").length;
    $('#dnevnik td').parent().remove();

    $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnikKorisnikRadnja.php?page=1&pages=" + brojStranica + "&radnja="+radnja+"&user="+korisnik+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function DohvatiDnevnikKorRadnjaSelectionChanged(korisnik,radnja){
    
    $('#dnevnik td').parent().remove();

    stranica = $("#page").find(":selected").text();
    stranica = parseInt(stranica);
    brojStranica = $("#page option").length;

        $.ajax({

        url: "sucelje_biblioteke/DohvatiDnevnikKorisnikRadnja.php?page="+stranica+"&pages=" + brojStranica + "&radnja="+radnja+"&user="+korisnik+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].dnevnik_id;
                var korisnik = json[i].korisnicko_ime;
                var tip_radnje = json[i].naziv_radnje;
                var datum_vrijeme = json[i].datum_vrijeme;
                var radnja = json[i].radnja;

                $("#dnevnik").append("<tr> <td>" + id + "</td> <td>" + korisnik + "</td> <td>" + tip_radnje + "</td> <td>" + datum_vrijeme + "</td> <td>" + radnja + "</td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}


