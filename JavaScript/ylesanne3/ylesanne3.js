//Ülesanne 3
//22.10.2024
//Artjom Skatškov TARpe23

// Sõidu aeg ja kaugus
function calculateTravelTime() {
    console.log("Sõidu aeg ja kiirus");
    
    const kaugus = document.getElementById("kaugus").value;
    const kiirus = document.getElementById("kiirus").value;

    if (kaugus && kiirus) {
        const aeg = kaugus / kiirus;
        document.getElementById("travelTimeResult").innerHTML = `${kaugus} km läbimiseks kiirusel ${kiirus} km/h kulub ${aeg.toFixed(2)} tundi.`;
    }

    return false;
}

// Postituste arv ja leheküljed
function calculatePages() {
    console.log("Postituste arv ja leheküljed");
    
    const koguPostitused = document.getElementById("koguPostitused").value;
    const postitusedLeheKohta = document.getElementById("postitusedLeheKohta").value;

    if (koguPostitused && postitusedLeheKohta) {
        const totalPages = Math.ceil(koguPostitused / postitusedLeheKohta);
        const lastPagePosts = koguPostitused % postitusedLeheKohta || postitusedLeheKohta;
        document.getElementById("pagesResult").innerHTML = `Kokku on vaja ${totalPages} lehekülge. Viimasel lehel on ${lastPagePosts} postitust.`;
    }

    return false;
}

// Serveri töökulu
function calculateServerCost() {
    console.log("Serveri töökulu");
    
    const serveriVõim = document.getElementById("serveriVõim").value;
    const elektriHind = document.getElementById("elektriHind").value / 100;

    if (serveriVõim && elektriHind) {
        const kulu = serveriVõim / 1000;
        const cost = kulu * elektriHind;
        document.getElementById("serverCostResult").innerHTML = `Serveri töökulu ühe tunni jooksul on: ${cost.toFixed(4)} eurot.`;
    }

    return false;
}