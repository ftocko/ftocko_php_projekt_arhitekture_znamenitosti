function NapuniComboBoxZnamenitost() {
   
    $.ajax({

        url: "sucelje_biblioteke/DohvatiZnamenitostiSelect.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var znamenitost = json[i].znamenitost;

                $("#nazivZnam").append("<option id="+znamenitost+" value="+znamenitost+">"+znamenitost +"</option>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

window.onload = NapuniComboBoxZnamenitost();


