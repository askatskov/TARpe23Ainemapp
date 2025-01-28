const apiUrl = "https://dummyjson.com/quotes";
const quoteList = document.getElementById("quote-list");
const filterCategory = document.getElementById("filter-category");
const loadingIndicator = document.getElementById("loading-indicator");

async function fetchQuotes() {
    try {
        loadingIndicator.style.display = "block";
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error("Tekkis viga tsitaatide laadimisel.");
        }
        const data = await response.json();
        return data.quotes;
    } catch (error) {
        console.error(error);
        alert("Tekkis viga tsitaatide laadimisel. Proovige hiljem uuesti.");
        return [];
    } finally {
        loadingIndicator.style.display = "none";
    }
}

function assignCategories(quotes) {
    return quotes.map((quote) => ({
        ...quote,
        category: `Autor: ${quote.author[0].toUpperCase()}`
    }));
}

function displayQuotes(quotes) {
    quoteList.innerHTML = "";
    quotes.forEach((quote) => {
        const card = document.createElement("div");
        card.className = "col-md-4";
        card.innerHTML = `
            <div class="card h-100">
                <div class="card-header"><strong>${quote.author}</strong></div>
                <div class="card-body">
                    <p>${quote.quote}</p>
                </div>
                <div class="card-footer text-muted">${quote.category}</div>
            </div>
        `;
        quoteList.appendChild(card);
    });
}

function populateFilterOptions(categories) {
    categories.forEach((category) => {
        const option = document.createElement("option");
        option.value = category;
        option.textContent = category;
        filterCategory.appendChild(option);
    });
}

function filterQuotes(quotes, category) {
    if (!category) return quotes;
    return quotes.filter((quote) => quote.category === category);
}

async function initialize() {
    let quotes = await fetchQuotes();
    quotes = assignCategories(quotes);
    const categories = [...new Set(quotes.map((quote) => quote.category))];
    populateFilterOptions(categories);
    displayQuotes(quotes);

    filterCategory.addEventListener("change", () => {
        const selectedCategory = filterCategory.value;
        const filteredQuotes = filterQuotes(quotes, selectedCategory);
        displayQuotes(filteredQuotes);
    });
}

initialize();
