function DohvatiGodineZnamenitosti() {


    $.ajax({

        url: "sucelje_biblioteke/DohvatiGodineSelect.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var godina = json[i].godina;

                $("#godina").append("<option value="+godina+">"+godina+"</option>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){
    
    DohvatiGodineZnamenitosti();
    $("#godina").sele
    
});



