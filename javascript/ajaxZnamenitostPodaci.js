function DohvatiPodatkeZnamenitosti(znamenitost) {
    

    $.ajax({
        
        url: "https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x093/sucelje_biblioteke/DohvatiZnamenitost.php?znamenitost=" + znamenitost + "",
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            
            for (i = 0; i < json.length; i++) {

                var kreirao = json[i].kreirao;
                var predlozio = json[i].predlozio;
                var godina = json[i].godina;
                

                $("#kreirao").val(kreirao);
                $("#predlozio").val(predlozio);
                $("#godina").val(godina);
                
                if(!predlozio){
                    $("#predlozio").val("Anoniman korisnik");
                }
                
                if(!kreirao){
                    $("#kreirao").val("Anoniman korisnik");
                }

            }


        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}




