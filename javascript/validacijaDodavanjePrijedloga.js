function ValidirajPrijedloge(){
    
    nazivZnam = $("#nazivZnam").val();
    opisZnam = $("#opisZnam").val().trim();
    
    if(nazivZnam.length===0||opisZnam.length===0){
        
        event.preventDefault();
        alert("Niste unijeli naziv ili opis znamenitosti!");
        
    }
    
}


