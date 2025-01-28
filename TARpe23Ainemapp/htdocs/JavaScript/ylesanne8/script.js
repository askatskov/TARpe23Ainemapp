const coins = [200, 0.2, 10, 0.01, 2, 1, 0.1, 0.02, 0.05, 100, 5, 0.5, 50, 20];

const sortedCoins = [];

let totalSum = 0;
let coinCount = 0;
let index = 0;

while (index < coins.length) {
    const coin = coins[index];
    
    if (coin < 4) {
        sortedCoins.push(coin);
        totalSum += coin;
        coinCount++;
    }
    index++;
}

document.getElementById("result").innerHTML = 
    `Müntide arv: ${coinCount}<br>Müntide summa: ${totalSum.toFixed(2)}<br>Mündid: [${sortedCoins.join(', ')}]`;
