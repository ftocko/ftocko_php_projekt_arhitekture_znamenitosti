function DohvatiZnamenitost(id) {
    

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZnamenitostiAzuriranje.php?id="+id+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            

            for (i = 0; i < json.length; i++) {

                $("#znamenitost").val(json[i].znamenitost_id);
                $("#zahtjev").val(json[i].zahtjev_id);
                $("#moderator").val(json[i].moderator_id);
                $("#predlozio").val(json[i].predlozio);
                $("#nazivZnam").val(json[i].naziv_znamenitosti);
                $("#opisZnam").val(json[i].opis);
                $("#godinaZnam").val(json[i].godina);
                $("#dateTime").val(json[i].datum_i_vrijeme_dodavanja);      

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}


