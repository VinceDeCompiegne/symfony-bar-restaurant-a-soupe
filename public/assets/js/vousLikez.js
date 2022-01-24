var tabAime = [20];
var tabReserve = [20];
window.addEventListener("load", function (event) {
    chargement()
});

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

        let nbrAime = 0;
        for (let i = 1; i <= 15; i++) {

            if ((tabAime[i])&&(nbrAime<3)) {
                nbrAime++;
                image = (tache["Plat_" + i]["image"] == "") ? "Bol_Fumant_M.gif" : "recette/" + tache["Plat_" + i]["image"];
                createPlat(tache["Plat_" + i]["nom"],image,tache["Plat_" + i]["id"]);
                
            }

        }
        
    } else {
        alert(encodeURI("local Storage non suporte sur ce navigateur !"));
    }
    console.log(document.getElementById("Plat1").style.height);
}

function createPlat(titre, image,platId) {
    
    let res1 = document.getElementById("vousAimezLigne");
    
    //art.classList.add("PlatRes");
    if (document.getElementById("ResCoeur") == null)
    {
    let res0 = document.getElementById("vousLikezText");
    let div0 = document.createElement("div");
    div0.style.height="60px";
    div0.style.width="100%";
    res0.appendChild(div0);
    let p = document.createElement("H3");
    p.id="ResCoeur";
    p.textContent = "Vous Likez";
    p.style="text-align:center;"
    div0.appendChild(p);
    }
    let art = document.createElement("article");
    //art.id = "Plat1";
    res1.appendChild(art);

    let div1 = document.createElement("div");
    div1.style.height="60px";
    art.appendChild(div1);

    let h4 = document.createElement("p");
    h4.textContent = titre;
    div1.appendChild(h4);
    
    let div2 = document.createElement("div");
    art.appendChild(div2);

    let img = document.createElement("img");
    img.src = "assets/images/"+image;
    img.alt = "Photo Plat 1";
    img.style.height="250px";
    div2.appendChild(img);

    let div3 = document.createElement("div");
    art.appendChild(div3);

    let form = document.createElement("form");
    form.style="margin-top:10px;"
    form.action="menu#Plat_"+platId;
    div3.appendChild(form);

    let buttom = document.createElement("input");
    buttom.type="submit";
    buttom.value="Commander";
    form.appendChild(buttom);

}