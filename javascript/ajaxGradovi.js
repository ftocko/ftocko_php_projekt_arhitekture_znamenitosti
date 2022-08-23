
function AjaxFunction() {
    
    brojStranica = $("#stranica option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiGradove.php?stranica=1&stranice="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_grada = json[i].naziv_grada;

                $("#gradovi").append("<td> <a href='Grad.php?grad="+ naziv_grada+"'style='color:black;'> "+naziv_grada+" </a> </td>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

window.onload = function(){
    
    AjaxFunction();
    
    $("#stranica").change(function () {

        $('#gradovi td').remove();
        
        stranica = $("#stranica").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#stranica option").length;
        
        $.ajax({

        url: "sucelje_biblioteke/DohvatiGradove.php?stranica="+stranica+"&stranice="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_grada = json[i].naziv_grada;

                $("#gradovi").append("<td> <a href='Grad.php?grad="+ naziv_grada+"'style='color:black;'> "+naziv_grada+" </a> </td>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
        
        
    });
    
    $("#pretraga").keyup(function () {

        $('#gradovi td').remove();
        
        imeGrada = $("#pretraga").val();
        
        $.ajax({

        url: "sucelje_biblioteke/DohvatiGradove.php?grad="+imeGrada+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_grada = json[i].naziv_grada;

                $("#gradovi").append("<td> <a href='Grad.php?grad="+ naziv_grada+"'style='color:black;'> "+naziv_grada+" </a> </td>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
        
        
    });
    
    
};

