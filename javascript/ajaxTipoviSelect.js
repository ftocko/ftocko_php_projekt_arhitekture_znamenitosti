function NapuniComboBoxTip() {
   
    $.ajax({

        url: "sucelje_biblioteke/DohvatiTipoveMaterijalaSelect.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var tip = json[i].tip;

                $("#tipMaterijala").append("<option id="+tip+" value="+tip+">"+tip +"</option>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

window.onload = NapuniComboBoxTip();


