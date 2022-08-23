function PrikaziGaleriju() {

    brojStranica = $("#page option").length;


    $.ajax({

        url: "sucelje_biblioteke/DohvatiMaterijale.php?page=1&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_materijala = json[i].naziv_materijala;
                var putanja = json[i].putanja;
                var tip = json[i].tip;

                if (tip == 1) {
                    $("#galerija").append("<figure> <img src='" + putanja + "'height='200' width='200'> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                } else if (tip == 2) {
                    $("#galerija").append("<figure> <video width='200' height='200' controls> <source src='" + putanja + "'> </video> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                } else if (tip == 3) {
                    $("#galerija").append("<figure> <audio controls> <source src='" + putanja + "'> </audio> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                }



            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

function PrikaziGalerijuSelectionChanged(){
    
        $("#galerija").empty();

        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;

        $.ajax({

            url: "sucelje_biblioteke/DohvatiMaterijale.php?page=" + stranica + "&pages=" + brojStranica + "",
            type: 'GET',
            dataType: 'json',
            success: function (json) {

                for (i = 0; i < json.length; i++) {

                    var naziv_materijala = json[i].naziv_materijala;
                    var putanja = json[i].putanja;
                    var tip = json[i].tip;

                    if (tip == 1) {
                        $("#galerija").append("<figure> <img src='" + putanja + "'height='200' width='200'> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    } else if (tip == 2) {
                        $("#galerija").append("<figure> <video width='200' height='200' controls> <source src='" + putanja + "'> </video> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    } else if (tip == 3) {
                        $("#galerija").append("<figure> <audio controls> <source src='" + putanja + "'> </audio> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    }

                }


            },

            error: function (xhr, status, error) {
                alert("Pogreška: " + error.responseText);
            }


        });
    
    
    
}

function PrikaziGalerijuGodina(godina){
    
        $("#galerija").empty();
        
        brojStranica = $("#page option").length;

        $.ajax({

            url: "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/sucelje_biblioteke/DohvatiMaterijale.php?godina=" + godina + "&page=1&pages=" + brojStranica + "",
            type: 'GET',
            dataType: 'json',
            success: function (json) {

                for (i = 0; i < json.length; i++) {

                    var naziv_materijala = json[i].naziv_materijala;
                    var putanja = json[i].putanja;
                    var tip = json[i].tip;

                    if (tip == 1) {
                        $("#galerija").append("<figure> <img src='" + putanja + "'height='200' width='200'> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    } else if (tip == 2) {
                        $("#galerija").append("<figure> <video width='200' height='200' controls> <source src='" + putanja + "'> </video> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    } else if (tip == 3) {
                        $("#galerija").append("<figure> <audio controls> <source src='" + putanja + "'> </audio> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    }


                }




            },

            error: function (xhr, status, error) {
                alert("Pogreška: " + error.responseText);
            }


        });
    
}

function PrikaziGalerijuGodinaSelectionChanged(godina){
        
        $("#galerija").empty();

        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;

        $.ajax({

            url: "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/sucelje_biblioteke/DohvatiMaterijale.php?godina=" + godina + "&page="+stranica+"&pages=" + brojStranica + "",
            type: 'GET',
            dataType: 'json',
            success: function (json) {

                for (i = 0; i < json.length; i++) {

                    var naziv_materijala = json[i].naziv_materijala;
                    var putanja = json[i].putanja;
                    var tip = json[i].tip;

                    if (tip == 1) {
                        $("#galerija").append("<figure> <img src='" + putanja + "'height='200' width='200'> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    } else if (tip == 2) {
                        $("#galerija").append("<figure> <video width='200' height='200' controls> <source src='" + putanja + "'> </video> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    } else if (tip == 3) {
                        $("#galerija").append("<figure> <audio controls> <source src='" + putanja + "'> </audio> <figcaption>" + naziv_materijala + "</figcaption> </figure>");
                    }


                }




            },

            error: function (xhr, status, error) {
                alert("Pogreška: " + error.responseText);
            }


        });
    
}


