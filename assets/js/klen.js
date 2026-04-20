class Calendar {
  constructor(selector, events = []) {
    this.container = document.querySelector(selector);
    this.events = events;
    this.date = new Date();

    this.render();
  }

  render() {
    const year = this.date.getFullYear();
    const month = this.date.getMonth();

    this.container.innerHTML = `
      <div class="calendar">
        <div class="calendar-header">
          <button id="prev-month">‹</button>
          <div id="month-year">${this.getMonthName(month)} ${year}</div>
          <button id="next-month">›</button>
        </div>

        <div class="calendar-weekdays">
          <div>Niedz</div><div>Pon</div><div>Wt</div>
          <div>Śr</div><div>Czw</div><div>Pt</div><div>Sob</div>
        </div>

        <div class="calendar-dates"></div>
      </div>
    `;

    this.renderDates(month, year);
    this.addEventListeners();
  }

  getMonthName(m) {
    return [
      "Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec",
      "Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"
    ][m];
  }

  renderDates(month, year) {
    const datesContainer = this.container.querySelector(".calendar-dates");
    datesContainer.innerHTML = "";

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
      datesContainer.appendChild(document.createElement("div"));
    }

    for (let d = 1; d <= daysInMonth; d++) {
      const cell = document.createElement("div");
      cell.classList.add("calendar-date");
      cell.textContent = d;

      const dateKey = `${year}-${String(month + 1).padStart(2,"0")}-${String(d).padStart(2,"0")}`;

      const dayEvents = this.events.filter(e => e.date === dateKey);

      dayEvents.forEach(e => {
        const dot = document.createElement("div");
        dot.classList.add("event-dot", e.type);
        cell.appendChild(dot);
      });

      cell.dataset.date = dateKey;
      datesContainer.appendChild(cell);
    }
  }

  addEventListeners() {
    this.container.querySelector("#prev-month").onclick = () => {
      this.date.setMonth(this.date.getMonth() - 1);
      this.render();
    };

    this.container.querySelector("#next-month").onclick = () => {
      this.date.setMonth(this.date.getMonth() + 1);
      this.render();
    };

    this.container.addEventListener("click", e => {
      if (!e.target.classList.contains("calendar-date")) return;

      const dateKey = e.target.dataset.date;
      const dayEvents = this.events.filter(ev => ev.date === dateKey);

      const list = document.getElementById("event-list");
      const title = document.getElementById("event-date-title");

      title.textContent = `Wydarzenia: ${dateKey}`;
      list.innerHTML = "";

      if (!dayEvents.length) {
        list.innerHTML = "<p>Brak wydarzeń</p>";
        return;
      }

      dayEvents.forEach(ev => {
        list.innerHTML += `
          <div class="event-item">
            <h4>${ev.title}</h4>
            <p>${ev.description || "Brak opisu"}</p>
          </div>
        `;
      });
    });
  }
}