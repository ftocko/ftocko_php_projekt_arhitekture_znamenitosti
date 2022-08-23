function DohvatiGradove() {
    
    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiGradovePregled.php?stranica=1&stranice="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].id;
                var naziv_grada = json[i].naziv_grada;
                var naziv_zupanije = json[i].naziv_zupanije;
                var gradonacelnik = json[i].gradonacelnik;
                

                $("#gradovi").append("<tr> <td>  "+id+"  </td> <td>  "+naziv_grada+"  </td> <td>  "+naziv_zupanije+"  </td> <td>  "+gradonacelnik+"  </td> <td> <a href='AzuriranjeGradova.php?grad="+naziv_grada+"' style='color:white;'> Ažuriraj </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){
    
    DohvatiGradove();
    
    $("#page").change(function () {

        $('#gradovi td').parent().remove();
        
        stranica = $("#page").find(":selected").text();
        stranica = parseInt(stranica);
        brojStranica = $("#page option").length;
        
        $.ajax({

        url: "sucelje_biblioteke/DohvatiGradovePregled.php?stranica="+stranica+"&stranice="+brojStranica+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var id = json[i].id;
                var naziv_grada = json[i].naziv_grada;
                var naziv_zupanije = json[i].naziv_zupanije;
                var gradonacelnik = json[i].gradonacelnik;
                

                $("#gradovi").append("<tr> <td>  "+id+"  </td> <td>  "+naziv_grada+"  </td> <td>  "+naziv_zupanije+"  </td> <td>  "+gradonacelnik+"  </td> <td> <a href='AzuriranjeGradova.php?grad="+naziv_grada+"' style='color:white;'> Ažuriraj </a> </td> </tr>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
        
        
    });
    
});




