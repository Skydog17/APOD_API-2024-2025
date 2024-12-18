
var menuAperto= false;
/*
////////////////////////// AVVIA LA RICERCA CON LA DATA INSERITA NEL FILTRO ///////////////////////////
function avviaRicerca(){
    var input = document.getElementById("dataFiltro").value;
    var d = new Date(input);
    richiesta(d);
    //cleanImage();   //Function dentro api.js
}*/

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
    return newD;
    //document.getElementById("data_immagine").innerHTML = newD;
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

////////////////////////// inserisce i dati dentro gli input così da poter mettere i dati nella table preferiti con php ///////////////////////////
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

////////////////////////// inserisce i dati dentro gli input così da poter mettere i dati nella table Cronologia con php ///////////////////////////
function changeFiltro(){
    var url = "https://api.nasa.gov/planetary/apod?api_key=";
    var api_key = "CH0wsKM4d6YOpvI7WI5tsulO3snZ5ybxueUIyb7l";
    //ESEMPIO QUERY = https://api.nasa.gov/planetary/apod?api_key=CH0wsKM4d6YOpvI7WI5tsulO3snZ5ybxueUIyb7l&date=2024-10-23
/*
    var titolo = "TEST"; //modifica il titolo
    var data = "2024-10-10";
    var desc = "LOREM IPSUM DOLORET";
    var urlFiltro = "img/error.jpg";*/

    var reqf = new XMLHttpRequest();
    var oggi = new Date();
    var primaFoto = "1995-06-16";
    var dataPrimaFoto = new Date(primaFoto);
    var d = document.getElementById('dataFiltro').value;
    d = new Date('d');

    if(d.getTime() < dataPrimaFoto.getTime() || d.getTime() > oggi.getTime()){
        window.alert("Data non valida");
        document.getElementById('valid').value="false";
    }
    else{
        document.getElementById('valid').value="true";
        var dataUtente = "&date="+ d;

        reqf.open("GET", url + api_key + dataUtente);
        reqf.send();
        reqf.addEventListener("load", function(){
            if(reqf.status == 200 && reqf.readyState == 4){ //Se non restituisce un codice di errore. 200 richiesta con successo e 4 operazione completata
                var responsef = JSON.parse(reqf.responseText); //JSON con la risposta

                document.getElementById("urlFiltro").value = responsef.url;
                document.getElementById("dataFiltroInput").value = formatDataEU(responsef.date);
                document.getElementById("titoloFiltroInput").value =  responsef.title;
                document.getElementById("descFiltroInput").value = formattaStringa(responsef.explanation);
                console.log(responsef.url + "\n" + formatDataEU(responsef.date) +"\n"+responsef.title+"\n"+formattaStringa(responsef.explanation));
            }
            else if(reqf.status == 404){

            }
            else{
            }
        })
    }

    /*
    var url = document.getElementById("immagine").src;
    if(url==""){
        url = document.getElementById("iframe").src;
    }
    */
}
