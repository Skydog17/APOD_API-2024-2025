/////////////////////////// MAIN FUNCTION ///////////////////////////

//ESEMPIO QUERY = https://api.nasa.gov/planetary/apod?api_key=CH0wsKM4d6YOpvI7WI5tsulO3snZ5ybxueUIyb7l&date=2024-10-23

function richiesta(d){ //d sarà una stringa
    var url = "https://api.nasa.gov/planetary/apod?api_key=";
    var api_key = "CH0wsKM4d6YOpvI7WI5tsulO3snZ5ybxueUIyb7l";
    //ESEMPIO QUERY = https://api.nasa.gov/planetary/apod?api_key=CH0wsKM4d6YOpvI7WI5tsulO3snZ5ybxueUIyb7l&date=2024-10-23
    document.getElementsByClassName("error").innerHTML="";
    defaultSize("immagine", "iframe");
    defaultSize("immagine-1", "iframe-1");
    defaultSize("immagine1", "iframe1");
    var req1 = new XMLHttpRequest(); //Request per la foto centrale
    var req2 = new XMLHttpRequest(); //Request per la foto centrale
    var req3 = new XMLHttpRequest(); //Request per la foto centrale

    if(d==''){
        d = new Date();
    }
    else{
        d = new Date(d);
    }

    var oggi = new Date();
    var primaFoto = "1995-06-16";
    var dataPrimaFoto = new Date(primaFoto);

    if(d.getTime() < dataPrimaFoto.getTime() || d.getTime() > oggi.getTime()){
        window.alert("Data non valida");
        d = new Date();
        dataCentrale = calcoloDate(d,0);
    }

    var dataCentrale = calcoloDate(d,0);
    var dataSinistra = calcoloDate(d,1);
    var dataDestra = calcoloDate(d,2);
    var dataUtente = "&date="+ dataCentrale;
    var dataIeri = "&date="+ dataSinistra;
    var dataDomani = "&date="+ dataDestra;
    
    d = d.toISOString(); //Formatto d perchè dovrò fare un controllo futuro
    d = d.slice(0,10); //prendo solo le info a me necessarie, "yyyy-mm-dd"
    oggi = oggi.toISOString(); 
    oggi = oggi.slice(0,10); 

//Richiesta per la foto centrale
    req1.open("GET", url + api_key + dataUtente);
    req1.send();
    req1.addEventListener("load", function(){
        if(req1.status == 200 && req1.readyState == 4){ //Se non restituisce un codice di errore. 200 richiesta con successo e 4 operazione completata
            var response1 = JSON.parse(req1.responseText); //JSON con la risposta
            document.getElementById("titolo_img").innerHTML = response1.title; //modifica il titolo

            document.getElementById("data_immagine").innerHTML = formatDataEU(response1.date);
            document.getElementById("descrizione_immagine").innerHTML = formattaStringa(response1.explanation);

            scegliMedia("immagine", "iframe", response1);
            change();
        }
        else if(req1.status == 404){
            window.alert("Immagine inesistente per questa data")
            document.getElementById("titolo_img").innerHTML = "Immagine inesistente";
            document.getElementById("descrizione_immagine").innerHTML = "Per favore cercare la foto di un altra data, grazie!";
            defaultSRC("immagine", "iframe");
        }
        else{
            defaultSRC("immagine", "iframe");
        }
    })

    //Richiesta per la foto sinistra
    req2.open("GET", url + api_key + dataIeri); 
    req2.send();
    req2.addEventListener("load", function(){
        if(req2.status == 200 && req2.readyState == 4){ //Se non restituisce un codice di errore. 200 richiesta con successo e 4 operazione completata
            var response2 = JSON.parse(req2.responseText); //JSON con la risposta
            scegliMedia("immagine-1", "iframe-1", response2);
        }
        else{
            defaultSRC("immagine-1", "iframe-1");
        }
    })

    //Richiesta per la foto destra
    
    req3.open("GET", url + api_key + dataDomani);
    req3.send();
    req3.addEventListener("load", function(){
        if(req3.status == 200 && req3.readyState == 4){ //Se non restituisce un codice di errore. 200 richiesta con successo e 4 operazione completata
            var response3 = JSON.parse(req3.responseText); //JSON con la risposta
            scegliMedia("immagine1", "iframe1", response3);
        }
        else{
            defaultSRC("immagine1", "iframe1");
        }
    })
}

/////////////////////////// Calcola la data e la mette nel formato corretto ///////////////////////////
function calcoloDate(d, selettore){ //d sarà un object Date
    var d0 = d; //dateCentrale, 0
    var tempoD0 = d0.getTime(); //prendo i millisecondi per fare i calcoli
    var d1 = tempoD0-8.64e+7; //Calcolo il giorno prima
    d1 = new Date(d1); //dateSinistra, 1
    var d2 = tempoD0+8.64e+7; //Calcolo il giorno dopo
    d2 = new Date(d2); //dateDestra, 2
    d0 = d0.toISOString(); //formatto
    d1 = d1.toISOString();
    d2 = d2.toISOString();
    d0 = d0.slice(0,10); //prendo solo le info a me necessarie, "yyyy-mm-dd"
    d1 = d1.slice(0,10);
    d2 = d2.slice(0,10);
    if(selettore == 0){
        return d0;  
    }
    else if(selettore == 1){
        return d1;
    }
    else if(selettore == 2){
        return d2;
    }
}

/////////////////////////// Apre l'immagine del giorno prima/seguente ///////////////////////////
function aprImmagine(num){

    var data = formatDataUSA();
    var d0 = new Date(data);
    var tempoD0 = d0.getTime();
    if(num==-1){
        var d1 = tempoD0-8.64e+7; //Calcolo il giorno prima
        d1 = new Date(d1);
        d1 = d1.toISOString();
        d1 = d1.slice(0,10); //prendo solo le info a me necessarie, "yyyy-mm-dd"
        richiesta(d1);
    }
    else if(num==1){
        var d2 = tempoD0+8.64e+7; //Calcolo il giorno prima
        d2 = new Date(d2);
        d2 = d2.toISOString();
        d2 = d2.slice(0,10); //prendo solo le info a me necessarie, "yyyy-mm-dd"
        richiesta(d2);
    }
}

/////////////////////////// Formatta la descrizione ///////////////////////////
function formattaStringa(stringa){
    stringa = "- " + stringa;
    var stringFormattata = stringa.replace(/\. /g, ".<br>- ");
    return stringFormattata;
}

/////////////////////////// Imposta se mostrare a schermo l'iframe o l'immagine ///////////////////////////
function scegliMedia(img, f, response){ //Id immagine, ID iframe e response
    if(response.media_type == "image"){
        document.getElementById(img).style.height = "auto";
        document.getElementById(img).style.width = "auto";
        document.getElementById(f).style.height = "0";
        document.getElementById(f).style.width = "0";
        document.getElementById(img).src = response.url;
    }
    else if(response.media_type == "video"){
        document.getElementById(f).style.height = "300px";
        document.getElementById(f).style.width = "500px";
        document.getElementById(img).style.height = "0";
        document.getElementById(img).style.width = "0";
        document.getElementById(f).src = response.url;
    }
    else{
        document.getElementById(img).style.height = "auto";
        document.getElementById(img).style.width = "auto";
        document.getElementById(f).style.height = "0";
        document.getElementById(f).style.width = "0";
        document.getElementById(img).src = "../img/error.jpg";
    }
    
}


function defaultSRC(img, f){
        document.getElementById(img).style.height = "auto";
        document.getElementById(img).style.width = "auto";
        document.getElementById(f).style.height = "0";
        document.getElementById(f).style.width = "0";
        document.getElementById(img).src = "../img/error.jpg";
}


function defaultSize(img, f){
        document.getElementById(img).style.height = "auto";
        document.getElementById(img).style.width = "auto";
        document.getElementById(f).style.height = "0";
        document.getElementById(f).style.width = "0";
}