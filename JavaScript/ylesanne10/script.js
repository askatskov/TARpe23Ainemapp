const toode = {
    nimetus: 'Näidis Toode',
    hind: 10.0,
    kogus: 5,
    koguhind: function() {
        return this.hind * this.kogus;
    },
    muudaKogus: function(uusKogus) {
        this.kogus = uusKogus;
    },
    kuvaToode: function() {
        console.log(`${this.nimetus} - ${this.hind} EUR - Kogus: ${this.kogus}`);
    }
};

toode.kuvaToode();
console.log("Toote koguhind:", toode.koguhind());
toode.muudaKogus(3);
toode.kuvaToode();

const ostukorv = {
    tooted: [
        { nimi: 'Piim', hind: 3.60, kogus: 2 },
        { nimi: 'Leib', hind: 2.00, kogus: 1 },
        { nimi: 'Munad', hind: 1.50, kogus: 6 },
        { nimi: 'Juust', hind: 4.20, kogus: 1 },
        { nimi: 'Tomatid', hind: 2.30, kogus: 3 },
    ],
    kuvaSisu: function() {
        this.tooted.forEach(toode => {
            console.log(`${toode.nimi} - ${toode.hind} EUR - Kogus: ${toode.kogus}`);
        });
    },
    lisaToode: function(nimi, hind, kogus) {
        this.tooted.push({ nimi, hind, kogus });
    },
    koguSumma: function() {
        return this.tooted.reduce((sum, toode) => sum + (toode.hind * toode.kogus), 0);
    }
};

function displayCart() {
    console.log("Ostukorv:");
    ostukorv.kuvaSisu();
}

function displayTotal() {
    console.log("Ostukorvi kogu summa:", ostukorv.koguSumma());
}
l
ostukorv.lisaToode('Kohv', 5.80, 2);
displayCart();
displayTotal();
