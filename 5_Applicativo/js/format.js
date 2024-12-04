
var menuAperto= false;
var searchAperto= false;

////////////////////////// APRE IL FILTRO ///////////////////////////
function apriFiltro(){
    if(searchAperto){
        document.getElementById("filtro").style.visibility = "hidden";
        document.getElementById("descrizione").style.visibility = "visible";
        
    }
    else{
        document.getElementById("filtro").style.visibility = "visible";
        document.getElementById("descrizione").style.visibility = "hidden";
    }  
    searchAperto=!searchAperto;
}

////////////////////////// AVVIA LA RICERCA CON LA DATA INSERITA NEL FILTRO ///////////////////////////
function avviaRicerca(){
    var input = document.getElementById("dataFiltro").value;
    var d = new Date(input);
    richiesta(d);
    document.getElementById("filtro").style.visibility = "hidden";
    //cleanImage();   //Function dentro api.js
}

////////////////////////// APRE IL MENU ///////////////////////////
function openMenu(){
    if(menuAperto){
        document.getElementById("menu").style.visibility = "hidden";
    }
    else{
        document.getElementById("menu").style.visibility = "visible";
    }
    menuAperto=!menuAperto;
}

/////////////////////////// FORMATTA LA DATA COL FORMAT EUROPEO dd.mm.yyyy///////////////////////////
function formatDataEU(data){ 

    var y = data.slice(0,4);
    var m = data.slice(5,7);
    var d = data.slice(8,10);
    var newD = d + "." +m+"."+y;
    document.getElementById("data_immagine").innerHTML = newD;
}

////////////////////////// FORMATTA LA DATA COL FORMAT AMERICANO yyyy.mm.dd ///////////////////////////
function formatDataUSA(){ 
var dF = document.getElementById("data_immagine").innerHTML;

var yF = dF.slice(6,10);
var mF = dF.slice(3,5);
var ddF = dF.slice(0,2);
var data = yF + "-" + mF + "-" + ddF;

dF = new Date(data);
dF = dF.toISOString();
dF = dF.slice(0,10);

return dF;
}

////////////////////////// inserisce i dati dentro gli input così da poter mettere i dati  nel DB con php ///////////////////////////
function change(){
    document.getElementById("url").value = " ";
    document.getElementById("dataInput").value = " ";
    document.getElementById("titoloInput").value = " ";
    document.getElementById("descInput").value = " ";
    //Gli input si svuotano così in caso di assenza di url non salvo quello sbagliato
    var data = formatDataUSA();
    var url = document.getElementById("immagine").src;
    if(url==""){
        url = document.getElementById("iframe").src;
    }
    var titolo = document.getElementById("titolo_img").innerHTML;
    var desc = document.getElementById("descrizione_immagine").innerHTML;
    document.getElementById("url").value = url;
    document.getElementById("dataInput").value = data;
    document.getElementById("titoloInput").value = titolo;
    document.getElementById("descInput").value = desc;
}