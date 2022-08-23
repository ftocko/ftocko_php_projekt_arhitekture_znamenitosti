function DohvatiVremenaRadnji() {

    $.ajax({

        url: "sucelje_biblioteke/DohvatiSvaVremenaRadnjiSelect.php",
        type: 'GET',
        dataType: 'json',
        success: function (json) {

            for (i = 0; i < json.length; i++) {
                
                var datum_vrijeme = json[i].datum_vrijeme;    
                
                $("#vrijemeOd").append("<option value='"+datum_vrijeme+"'>"+datum_vrijeme+"</option>");
                $("#vrijemeDo").append("<option value='"+datum_vrijeme+"'>"+datum_vrijeme+"</option>");

            }

        },

        error: function (xhr, status, error) {
            alert("Pogreška: " + error.responseText);
        }


    });

}

$(document).ready(function(){
    
    DohvatiVremenaRadnji();
    
});


