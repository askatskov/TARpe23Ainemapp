let hours = 2;
let minutes = 38;
let seconds = 59;
let time = `${hours}:${minutes}:${seconds}PM`;
console.log(time);

let quote = "The only limit to our realization of tomorrow is our doubts of today.";
let author = "Franklin D. Roosevelt";
let fullQuote = `"${quote}" - ${author}`;
console.log(fullQuote);

let firstName = "Jüri";
let lastName = "Jurakas";
let initials = `${firstName[0]}.${lastName[0]}`;
console.log(`${firstName} ${lastName} nimetähed on ${initials}.`);

let fullName = "Jurakas, Jüri";
let commaIndex = fullName.indexOf(",");
let lastNameFromFull = fullName.slice(0, commaIndex);
let lastNameUpperCase = lastNameFromFull.toUpperCase();
console.log(lastNameUpperCase);
console.log(lastNameUpperCase.length);

let email = "karrolk@netlog.com";
let updatedEmail = email.replace("netlog", "gmail");
console.log(updatedEmail);

let data = "1,Marshal,Martinovic,mmartinovic0@dedecms.com,Male,40.19.226.175";
let dataArray = data.split(",");
let ip = dataArray[5];
let emailUsername = dataArray[3].split("@")[0];
console.log(ip);
console.log(emailUsername);
