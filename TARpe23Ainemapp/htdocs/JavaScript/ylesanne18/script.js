document.addEventListener("DOMContentLoaded", () => {
    const firstNameInput = document.getElementById("firstName"); 
    const lastNameInput = document.getElementById("lastName");
    const emailInput = document.getElementById("email");

    const firstNameVal = document.getElementById("firstNameVal");
    const lastNameVal = document.getElementById("lastNameVal");
    const emailVal = document.getElementById("emailVal");

    const nameRegex = /^[a-zA-ZäöüõÄÖÜÕ]{2,}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const validateField = (input, regex, errorField, errorMessage) => {
        if (regex.test(input.value.trim())) {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
            errorField.textContent = "";
        } else {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");
            errorField.textContent = errorMessage;
        }
    };

    firstNameInput.addEventListener("input", () => {
        validateField(
            firstNameInput,
            nameRegex,
            firstNameVal,
            "Eesnimi peab sisaldama vähemalt 2 tähte ja ainult tähestiku märke."
        );
    });

    lastNameInput.addEventListener("input", () => {
        validateField(
            lastNameInput,
            nameRegex,
            lastNameVal,
            "Perekonnanimi peab sisaldama vähemalt 2 tähte ja ainult tähestiku märke."
        );
    });

    emailInput.addEventListener("input", () => {
        validateField(
            emailInput,
            emailRegex,
            emailVal,
            "Palun sisestage korrektne e-posti aadress."
        );
    });
});
