function ValidirajZahtjeve(){
    
    
    nazivZnam = $("#nazivZnamenitosti").val();
    godinaZnam = $("#godinaZnamenitosti").val();
    opisZnam = $("#opisZnamenitosti").val().trim();
    
    if(nazivZnam.length===0||godinaZnam.length===0||opisZnam.length===0){
        
        event.preventDefault();
        alert("Niste unijeli sve podatke za zahtjev!");
        
    }
    
}


