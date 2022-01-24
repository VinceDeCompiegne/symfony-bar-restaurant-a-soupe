var tabAime = [20];
var tabReserve = [20];
window.addEventListener("load", function (event) {
    chargement()
});

function reserver(){

    if (typeof localStorage != "undefined") {

         let tache = JSON.parse(localStorage.getItem("PlatRestaurant"));
        
        // tab = [];
        // for (item in tache){
        //     tab.push(tache[item]);
        // }

         var str_json = JSON.stringify(tache);

        var xhr = new XMLHttpRequest;

        xhr.open("GET", `/api/ajoute/reservation?reservation=`+str_json, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();
    
        xhr.onreadystatechange = function () {
            if ((xhr.readyState == 4) && ((xhr.status == 200) || (xhr.status == 0))) {
                alert(xhr.response);
                var dataAJAX = JSON.parse(xhr.response);
                
            }
        }

    } else {
        alert(encodeURI("local Storage non suporte sur ce navigateur !"));
    }
}

function chargement() {

    for (i = 0; i <= 15; i++) {
        tabAime[i] = 0;
        tabReserve[i] = 0;;
    }

    if (typeof localStorage != "undefined") {

        let tache = JSON.parse(localStorage.getItem("PlatRestaurant"));
        //console.log(tache);
        
        for (index = 1; index <= 15; index++) {
            tabAime[index] = tache["Plat_" + index]["aime"];
            tabReserve[index] = tache["Plat_" + index]["reservation"];
        }

        for (let i = 1; i <= 15; i++) {

            if (tabReserve[i]) {
                let nbrPlat = (isNaN(tache["Plat_" + i]["nombre"])) ? 1 : tache["Plat_" + i]["nombre"];
                nbrPlat = (tache["Plat_" + i]["nombre"] == 0) ? 1 : tache["Plat_" + i]["nombre"];
                image = (tache["Plat_" + i]["nombre"] == "") ? "Bol_Fumant_M.gif" : "/recette/" + tache["Plat_" + i]["image"];
                createPlat(tache["Plat_" + i]["nom"], " X " + nbrPlat,image);
            }

        }
        
    } else {
        alert(encodeURI("local Storage non suporte sur ce navigateur !"));
    }
    console.log(document.getElementById("Plat1").style.height);

    tableau();
}

function createPlat(titre, nbr, image , Prix) {
    
    let res1 = document.getElementById("ReservationLigne");
    let art = document.createElement("article");
    art.classList.add("PlatRes");
    art.id = "Plat1";
    res1.appendChild(art);

    let div1 = document.createElement("div");
    div1.style.height="60px";
    art.appendChild(div1);

    let h4 = document.createElement("h4");
    h4.textContent = titre;
    div1.appendChild(h4);
    
    let div2 = document.createElement("div");
    art.appendChild(div2);

    let img = document.createElement("img");
    img.src = "assets/images/"+image;
    img.alt = "Photo Plat 1";
    img.style.maxHeight="200px";
    img.style.maxwidth="200px";
    div2.appendChild(img);

    let div = document.createElement("div");
    div.classList.add("BoutonReservation");
    div2.appendChild(div);

    let p = document.createElement("p");
    p.classList.add("ResCoeur");
    p.textContent = nbr;
    div2.appendChild(p);

}

function tableau()
{
    let div = document.getElementById("Detail");
    
    let dataAJAX = JSON.parse(localStorage.getItem("PlatRestaurant"));

    let span = document.createElement("div");
        span.id= "detail__div";
        div.appendChild(span);

        // span.innerHTML="<table><tbody><tr>";
        let result = 0;
        let string = `<style>table td{width:100px;}</style></style><div style="font-size:36px;margin-bottom:25px;margin-left:auto;margin-right:auto;width:500px;text-align:center;"><H2">Detail de la commande</H2></div>`;
        string += "<table style='margin-left:auto;margin-right:auto;width:600px;''><tbody>";
        string +='<tr><th>plat</th><th>nombre</th><th>Prix unitaire(€)</th><th>Prix(€)</th></tr>';
        let total = 0;
    for (item in dataAJAX) {
        if (dataAJAX[item]["reservation"] == "1"){
        result = parseFloat(parseFloat(dataAJAX[item]["nombre"])*parseFloat(dataAJAX[item]["prix"])).toFixed(2);
        string +=`<tr><td>${dataAJAX[item]["nom"]}</td>
        <td>${dataAJAX[item]["nombre"]}</td>
        <td>${dataAJAX[item]["prix"]}</td>
        <td  style="width:100px;">${result}</td></tr>`;
        total = total + parseFloat(result);
        //a.innerHTML+=dataAJAX[item][2] + " " + dataAJAX[item][3]  + "</br>";
        }
    }
        string+=`<td></td><td></td><td></td><td></td><td></td></tr>`;
        string+=`<td></td><td></td><td><B>TOTAL:</B></td><td>${total.toFixed(2)}€</td></tr>`;
        string+="</tbody></table>";
        span.innerHTML=string;


}


