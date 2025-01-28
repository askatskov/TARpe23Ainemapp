const themeButton = document.getElementById("theme");
themeButton.addEventListener("click", () => {
    console.log("pihtas");

    if (themeButton.classList.contains("btn-dark")) {
        themeButton.classList.replace("btn-dark", "btn-light");
        themeButton.textContent = "Light Theme";
    } else {
        themeButton.classList.replace("btn-light", "btn-dark");
        themeButton.textContent = "Dark Theme";
    }

    document.body.classList.toggle("dark");
});
