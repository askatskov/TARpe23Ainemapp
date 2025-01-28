document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const output = document.querySelector(".vastusekast");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const firstName = document.getElementById("firstName").value;
        const lastName = document.getElementById("lastName").value;
        const email = document.getElementById("email").value;
        const gender = document.querySelector("input[name='gender']:checked")?.value || "Pole valitud";
        const city = document.getElementById("city").value;
        const country = document.getElementById("country").value;
        const password = document.getElementById("password").value;

        output.innerHTML = `
            <p><strong>Eesnimi:</strong> ${firstName}</p>
            <p><strong>Perekonnanimi:</strong> ${lastName}</p>
            <p><strong>E-post:</strong> ${email}</p>
            <p><strong>Sugu:</strong> ${gender}</p>
            <p><strong>Linn:</strong> ${city}</p>
            <p><strong>Riik:</strong> ${country}</p>
            <p><strong>Parool:</strong> ${"*".repeat(password.length)}</p>
        `;
    });
});
