//Artjom Skatškov TARpe23
//Ylesanne 5
//22.10.2024


// Temperatuurikontroll
function kontrolliTemperatuur() {
    let temperatuur = parseFloat(document.getElementById("temperatuur").value);
    let output = document.getElementById("output");
    if (isNaN(temperatuur)) {
        output.textContent = "Palun sisesta kehtiv temperatuur.";
        return;
    }
    if (temperatuur > 25) {
        output.textContent = "Väga kuum ilm!";
    } else if (temperatuur >= 15 && temperatuur <= 25) {
        output.textContent = "Mõnus temperatuur";
    } else {
        output.textContent = "Jahe ilm";
    }
}

//Kasutajanime kontroll
function kontrolliKasutajanimi() {
    let kasutajanimi = document.getElementById("kasutajanimi").value;
    let output = document.getElementById("output");
    if (kasutajanimi === "admin") {
        output.textContent = "Tere, administraator!";
    } else {
        output.textContent = "Tere, külaline!";
    }
}
 //Ürituse piletite hind
function arvutaPiletihind() {
    let vanus = parseInt(document.getElementById("vanus").value);
    let piletitüüp = document.getElementById("piletitüüp").value;
    let output = document.getElementById("output");
    let hind;
    if (isNaN(vanus) || vanus < 0) {
        output.textContent = "Palun sisesta kehtiv vanus.";
        return;
    }
    if (piletitüüp === "täispilet") {
        if (vanus < 18) {
            hind = 10;
        } else if (vanus >= 18 && vanus < 65) {
            hind = 20;
        } else {
            hind = 15;
        }
    } else if (piletitüüp === "sooduspilet") {
        if (vanus < 18 || vanus >= 65) {
            hind = 8;
        } else {
            hind = 15;
        }
    }
    output.textContent = `Pileti hind on: ${hind} eurot.`;
}