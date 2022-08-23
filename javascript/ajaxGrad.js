function AjaxFunction(grad) {

    brojStranica = $("#page option").length;

    $.ajax({

        url: "sucelje_biblioteke/DohvatiGrad.php?grad=" + grad + "&page=1&pages=" + brojStranica + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                var naziv_znamenitosti = json[i].naziv_znamenitosti;

                $("#GradPodaci").append("<a href='Znamenitost.php?znamenitost="+ naziv_znamenitosti+"&grad="+grad+"'style='color:black;'> <dt style='box-sizing:border-box;display:block;padding:15px;background-color:white;color:black; border:thick,black,solid;'>"+ naziv_znamenitosti+ "</dt> </a>");

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

function AjaxFunctionSelectionChanged(grad){
        
                $('#GradPodaci dt').remove();
                stranica = $("#page").find(":selected").text();
                stranica = parseInt(stranica);
                brojStranica = $("#page option").length;
                
                 $.ajax({

                    url: "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/sucelje_biblioteke/DohvatiGrad.php?grad="+grad+"&page="+stranica+"&pages="+brojStranica+"",
                    type: 'GET',
                    dataType: 'json',
                    success: function (json) {

                         for (i = 0; i < json.length; i++) {

                                 var naziv_znamenitosti = json[i].naziv_znamenitosti;

                                 $("#GradPodaci").append("<a href='Znamenitost.php?znamenitost="+ naziv_znamenitosti+"&grad="+grad+"' style='color:black;'> <dt style='box-sizing:border-box;display:block;padding:15px;background-color:white;color:black; border:thick,black,solid;'>"+ naziv_znamenitosti+ "</dt> </a>");

                        }


                },

                error: function (xhr, status, error) {
                         alert("Pogreška: " + error.responseText);
                }


            });
        
        
      
}

function GetGrad(grad){
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiGradUpdate.php?grad="+grad+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                $("#nazivGrada").val(json[i].naziv_grada);
                $("#nazivZupanije").val(json[i].naziv_zupanije);
                $("#imePreGradonacelnika").val(json[i].gradonacelnik);

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}



function GetGradLista(grad){
    
    $.ajax({

        url: "sucelje_biblioteke/DohvatiGradUpdate.php?grad="+grad+"",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {

                $("#naziv").val(json[i].naziv_grada);
                $("#zupanija").val(json[i].naziv_zupanije);
                $("#gradonacelnik").val(json[i].gradonacelnik);

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });
    
}

function PretragaPoZnamenitosti(grad){
    
        $('#GradPodaci dt').remove();
        
        imeZnamenitosti = $("#pretraga").val();
        
        $.ajax({

                    url: "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/sucelje_biblioteke/DohvatiGrad.php?grad="+grad+"&znamenitost="+imeZnamenitosti+"",
                    type: 'GET',
                    dataType: 'json',
                    success: function (json){

                         for (i = 0; i < json.length; i++) {

                                 var naziv_znamenitosti = json[i].naziv_znamenitosti;

                                 $("#GradPodaci").append("<a href='Znamenitost.php?znamenitost="+ naziv_znamenitosti+"&grad="+grad+"' style='color:black;'> <dt style='box-sizing:border-box;display:block;padding:15px;background-color:white;color:black; border:thick,black,solid;'>"+ naziv_znamenitosti+ "</dt> </a>");

                        }


                },

                error: function (xhr, status, error) {
                         alert("Pogreška: " + error.responseText);
                }


            });

    
}










