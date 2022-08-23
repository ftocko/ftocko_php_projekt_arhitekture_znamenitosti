function NapuniComboBoxGrad() {
   
    $.ajax({

        url: "sucelje_biblioteke/DohvatiGradoveSelect.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_grada = json[i].naziv_grada;

                $("#grad").append("<option id="+naziv_grada+" value="+naziv_grada+">"+naziv_grada +"</option>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

window.onload = NapuniComboBoxGrad();


