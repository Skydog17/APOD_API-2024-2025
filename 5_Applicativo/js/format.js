var menuAperto= false;
var searchAperto= false;

function apriFiltro(){
    if(searchAperto){
        document.getElementById("filtro").style.visibility = "hidden";
        
    }
    else{
        document.getElementById("filtro").style.visibility = "visible";
    }  
    searchAperto=!searchAperto;
}

function avviaRicerca(){
    var input = document.getElementById("dataFiltro").value;
    var d = new Date(input);
    richiesta(d);
    document.getElementById("filtro").style.visibility = "hidden";
    //cleanImage();   //Function dentro api.js
}

function openMenu(){
    if(menuAperto){
        document.getElementById("menu").style.visibility = "hidden";
    }
    else{
        document.getElementById("menu").style.visibility = "visible";
    }
    menuAperto=!menuAperto;
}

