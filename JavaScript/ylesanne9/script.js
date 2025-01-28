function minuNimi() {
    alert("Artjom");
}

const minuNimiNoolefunktsioon = () => {
    alert("Artjom");
};

function kuupaevEesti() {
    const kuud = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
    const kuupaev = document.getElementById("kuupaev").value;
    const [paev, kuu, aasta] = kuupaev.split(".");
    const kuuIndex = parseInt(kuu, 10) - 1;
    document.getElementById("kuupaevTulemus").innerText = `${paev}. ${kuud[kuuIndex]} ${aasta}`;
}

function arvutaSummaJaKeskmine() {
    const arvud = document.getElementById("numbrid").value.split(",").map(Number);
    const kogusumma = arvud.reduce((summa, arv) => summa + arv, 0);
    const keskmine = kogusumma / arvud.length;
    document.getElementById("summaKeskmineTulemus").innerText = `Summa: ${kogusumma}, Keskmine: ${keskmine}`;
}

const salajaneSonum = () => {
    const sonum = document.getElementById("sonum").value;
    const salajane = sonum.replace(/[aeiouõäöüAEIOUÕÄÖÜ]/g, "*");
    document.getElementById("salajaneSonumTulemus").innerText = salajane;
};

const leiaUnikaalsedNimed = () => {
    const nimed = document.getElementById("nimed").value.split(",");
    const unikaalsed = nimed.filter((nimi, index) => nimed.indexOf(nimi) === index);
    document.getElementById("unikaalsedNimedTulemus").innerText = unikaalsed.join(", ");
};
