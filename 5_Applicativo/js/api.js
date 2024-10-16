/////////////////////////// MAIN FUNCTION ///////////////////////////
function richiesta(d){ //d sarà una stringa
    cleanImage(); //Senza questo se l'immagine a destra o sinistra non esistevano, url rimanevo quello vecchio
    var req1 = new XMLHttpRequest(); //Request per la foto centrale
    var req2 = new XMLHttpRequest(); //Request per la foto centrale
    var req3 = new XMLHttpRequest(); //Request per la foto centrale
    var url = "https://api.nasa.gov/planetary/apod?api_key=";
    var api_key = "CH0wsKM4d6YOpvI7WI5tsulO3snZ5ybxueUIyb7l";

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
            document.getElementById("immagine").src = response1.url; //modifica il src dell'immagine in SD
            document.getElementById("titolo_img").textContent = response1.title; //modifica il titolo
            document.getElementById("data_immagine").textContent = response1.date;
            document.getElementById("descrizione_immagine").textContent = response1.explanation;
            //createImgVid(req1, 0)
        }
    })

    //Richiesta per la foto sinistra
    req2.open("GET", url + api_key + dataIeri); 
    req2.send();
    req2.addEventListener("load", function(){
        if(req2.status == 200 && req2.readyState == 4){ //Se non restituisce un codice di errore. 200 richiesta con successo e 4 operazione completata
            var response2 = JSON.parse(req2.responseText); //JSON con la risposta
            document.getElementById("immagine-1").src = response2.url; //modifica il src dell'immagine
        }
    })

    //Richiesta per la foto destra
    req3.open("GET", url + api_key + dataDomani);
    req3.send();
    req3.addEventListener("load", function(){
        if(req3.status == 200 && req3.readyState == 4){ //Se non restituisce un codice di errore. 200 richiesta con successo e 4 operazione completata
            var response3 = JSON.parse(req3.responseText); //JSON con la risposta
            document.getElementById("immagine1").src = response3.url; //modifica il src dell'immagine //modifica il src dell'immagine
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

/////////////////////////// Svuota le immagini ///////////////////////////
function cleanImage(){
    document.getElementById("immagine").src = "";
    document.getElementById("immagine-1").src = "";
    document.getElementById("immagine1").src = "";
}


function aprImmagine(num){
    var data = document.getElementById("data_immagine").innerHTML.valueOf();
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


/////////////////////////// Crea il tag img o video ///////////////////////////
function createImgVid(r, num){
    var immagini ="";
    if(num == 0){
        if(r.media_type=="image"){
            immagini += "<img id='immagine'></img>";
        }
        else{
            immagini += "<video id ='immagine' width='auto' height='auto' controls> <source type='video/mp4'></video>";
        }
    }

    else if(num ==-1){
        if(r.media_type=="image"){
            immagini+="<img class='smallerImg' id='immagine-1' onclick='aprImmagine(-1)'>";
        }
        else{
            immagini+="<video id ='immagine-1' width='auto' height='auto' controls onclick='aprImmagine(-1)'> <source type='video/mp4'></video>";
        }
    }

    else if(num==1){
        if(r.media_type=="image"){
            immagini+="<img class='smallerImg' id='immagine1' onclick='aprImmagine(1)'></img>";
        }
        else{
            var source = r.url;
            immagini+="<video id ='immagine1' width='auto' height='auto' controls onclick='aprImmagine(-1)'> <source src='"+source + "' type='video/mp4'></video>";
        }
    }
    console.log(immagini)
}