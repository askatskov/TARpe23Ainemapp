const cards = document.querySelectorAll(".card");

cards.forEach(card => {
    const img = card.querySelector(".card-img-top");
    const title = img.getAttribute("data-title");
    const description = img.getAttribute("data-description");

    const cardTitle = card.querySelector(".card-title");
    const cardText = card.querySelector(".card-text");

    if (cardTitle) {
        cardTitle.textContent = title;
    }
    if (cardText) {
        cardText.textContent = description;
    }
});
