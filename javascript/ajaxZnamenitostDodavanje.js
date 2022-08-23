function DohvatiZahtjevZaZnamenitost(id,moderator) {
    

    $.ajax({

        url: "sucelje_biblioteke/DohvatiZahtjevZaZnamenitost.php?id="+id+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            
            $('#tablicaZnamenitosti td').remove();

            for (i = 0; i < json.length; i++) {

                $("#zahtjev").val(json[i].zahtjev_id);
                $("#predlozio").val(json[i].predlozio);
                $("#nazivZnam").val(json[i].naziv_znamenitosti);
                $("#opisZnam").val(json[i].opis_znamenitosti);
                $("#godinaZnam").val(json[i].godina_znamenitosti);
                $("#moderator").val(moderator);

            }
        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });


}


