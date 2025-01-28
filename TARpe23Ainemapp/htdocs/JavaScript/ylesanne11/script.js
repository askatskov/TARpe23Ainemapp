const nimed = [
    "mari maasikas", "jaan jõesaar", "kristiina kukk", "margus mustikas", 
    "jaak järve", "kadi kask", "Toomas Tamm", "Kadi Meri", "Leena Laas", 
    "Madis Mets", "Hannes Hõbe", "Anu Allikas", "Kristjan Käär", "Eva Esimene", 
    "Jüri Jõgi", "Liis Lepik", "Kalle Kask", "Tiina Teder", "Kaidi Koppel", 
    "tiina Toom"
];

const korrastaNimed = nimed.map(nimi => {
    return nimi.toLowerCase().split(' ').map(part => part.charAt(0).toUpperCase() + part.slice(1)).join(' ');
});

const emailid = korrastaNimed.map(nimi => {
    const perenimi = nimi.split(' ')[1].toLowerCase();
    return `${perenimi}@metshein.com`;
});

function showNames() {
    korrastaNimed.forEach((nimi, index) => {
        console.log(`Nimi: ${nimi}, Email: ${emailid[index]}`);
    });
}

function otsiNimi(nimi) {
    const leitud = korrastaNimed.find(n => n.toLowerCase() === nimi.toLowerCase());
    if (leitud) {
        console.log("Nimi leitud:", leitud);
    } else {
        console.log("Nime ei leitud.");
    }
}

function searchNamePrompt() {
    const nimi = prompt("Sisesta nimi, mida otsida:");
    otsiNimi(nimi);
}

const inimesteAndmed = [
    { nimi: "Mari Maasikas", isikukood: "38705123568" },
    { nimi: "Jaan Jõesaar", isikukood: "49811234567" },
    { nimi: "Kristiina Kukk", isikukood: "39203029876" },
    { nimi: "Margus Mustikas", isikukood: "49807010346" },
    { nimi: "Jaak Järve", isikukood: "39504234985" },
    { nimi: "Kadi Kask", isikukood: "39811136789" }
];

function arvutaSunniaegJaVanus(isikukood) {
    const aastaEsimeneNumber = isikukood.charAt(0);
    const aasta = (aastaEsimeneNumber < 5 ? "19" : "20") + isikukood.slice(1, 3);
    const kuu = isikukood.slice(3, 5);
    const paev = isikukood.slice(5, 7);

    const sunniaeg = new Date(`${aasta}-${kuu}-${paev}`);
    const vanus = new Date().getFullYear() - sunniaeg.getFullYear();
    
    return { sunniaeg, vanus };
}

function showBirthdatesAndAges() {
    inimesteAndmed.forEach(inimene => {
        const { sunniaeg, vanus } = arvutaSunniaegJaVanus(inimene.isikukood);
        console.log(`Nimi: ${inimene.nimi}, Sünniaeg: ${sunniaeg.toLocaleDateString()}, Vanus: ${vanus}`);
    });
}

const opilased = [
    { nimi: "Anna", tulemused: [4.5, 4.8, 4.6] },
    { nimi: "Mart", tulemused: [5.2, 5.1, 5.4] },
    { nimi: "Kati", tulemused: [4.9, 5.0, 4.7] },
    { nimi: "Jaan", tulemused: [4.3, 4.6, 4.4] },
    { nimi: "Liis", tulemused: [5.0, 5.2, 5.1] },
    { nimi: "Peeter", tulemused: [5.5, 5.3, 5.4] },
    { nimi: "Eva", tulemused: [4.8, 4.9, 4.7] },
    { nimi: "Marten", tulemused: [4.7, 4.6, 4.8] },
    { nimi: "Kairi", tulemused: [5.1, 5.3, 5.0] },
    { nimi: "Rasmus", tulemused: [4.4, 4.5, 4.3] }
];

function showLongJumpResults() {
    opilased.forEach(opilane => {
        const parimTulemus = Math.max(...opilane.tulemused);
        const keskmineTulemus = (opilane.tulemused.reduce((a, b) => a + b, 0) / opilane.tulemused.length).toFixed(2);
        console.log(`Õpilane: ${opilane.nimi}, Parim tulemus: ${parimTulemus}, Keskmine tulemus: ${keskmineTulemus}`);
    });
}
