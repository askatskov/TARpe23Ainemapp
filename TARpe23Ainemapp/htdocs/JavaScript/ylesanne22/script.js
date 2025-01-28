const themeButton = document.getElementById("theme");

window.addEventListener("load", () => {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark");
        themeButton.classList.replace("btn-dark", "btn-light");
        themeButton.textContent = "Light Theme";
    }
});

themeButton.addEventListener("click", () => {
    if (themeButton.classList.contains("btn-dark")) {
        themeButton.classList.replace("btn-dark", "btn-light");
        themeButton.textContent = "Light Theme";
        document.body.classList.add("dark");
        localStorage.setItem("theme", "dark");
    } else {
        themeButton.classList.replace("btn-light", "btn-dark");
        themeButton.textContent = "Dark Theme";
        document.body.classList.remove("dark");
        localStorage.setItem("theme", "light");
    }
});
