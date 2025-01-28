function polarity() {
    const input = prompt("Sisesta arv");
    const number = parseFloat(input);
    if (isNaN(number)) {
        alert(`Sisestatud väärtus (${input}) ei ole number.`);
        return;
    }
    switch (true) {
        case number < 0: {
            alert(`Arv ${number} on negatiivne.`);
            break;
        }
        default:{
            alert(`Arv ${number} on positiivne`);
            break
        }

    }
}

function valiLaud() {
    const input = prompt("Sisesta broneeringu arv");
    const broneeringArv = parseInt(input);
    
    if (isNaN(broneeringArv)) {
      alert(`Sisestatud väärtus (${input}) ei ole number.`);
      return;
    }
  
    switch (true) {
      case (broneeringArv === 1 || broneeringArv === 2):
        alert("Valige laud kahele inimesele.");
        break;
      case (broneeringArv === 3 || broneeringArv === 4):
        alert("Valige laud neljale inimesele.");
        break;
      case (broneeringArv === 5 || broneeringArv === 6):
        alert("Valige laud kuuele inimesele.");
        break;
      case (broneeringArv > 6):
        alert("Valige suur laud.");
        break;
      default:
        alert("Palun sisestage korrektne broneeringu arv.");
    }
}
