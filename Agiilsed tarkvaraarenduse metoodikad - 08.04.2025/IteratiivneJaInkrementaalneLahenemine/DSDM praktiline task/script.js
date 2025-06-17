document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("mood-form");
  const list = document.getElementById("list");

  let moods = JSON.parse(localStorage.getItem("moods")) || [];
  renderList();

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const date = form.date.value;
    const mood = form.mood.value;
    const reason = form.reason.value.trim();

    if (!date || !mood) {
      alert("Palun vali kuupäev ja meeleolu!");
      return;
    }

    const entry = {
      id: Date.now(),
      date,
      mood,
      reason
    };

    moods.push(entry);
    saveAndRender();
    form.reset();
  });

  function saveAndRender() {
    localStorage.setItem("moods", JSON.stringify(moods));
    renderList();
  }

  function renderList() {
    list.innerHTML = "";
    if (moods.length === 0) {
      list.innerHTML = "<li>Ühtegi sissekannet pole veel lisatud.</li>";
      return;
    }

    moods.forEach((entry) => {
      const li = document.createElement("li");
      li.innerHTML = `
        <strong>${entry.date}</strong> — ${entry.mood}
        ${entry.reason ? `<p>Põhjus: ${entry.reason}</p>` : ""}
        <button class="delete-btn" data-id="${entry.id}">Kustuta</button>
      `;
      list.appendChild(li);
    });

    document.querySelectorAll(".delete-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = Number(btn.getAttribute("data-id"));
        moods = moods.filter(e => e.id !== id);
        saveAndRender();
      });
    });
  }
});
