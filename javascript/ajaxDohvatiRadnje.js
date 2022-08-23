function DohvatiSveRadnje() {

    $.ajax({

        url: "sucelje_biblioteke/DohvatiRadnje.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {
                
                var naziv_radnje = json[i].naziv_radnje;
                $("#radnja").append("<option value='"+naziv_radnje+"'>"+naziv_radnje+"</option>");

            }

        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){
    
    
    DohvatiSveRadnje();
    
    
});


