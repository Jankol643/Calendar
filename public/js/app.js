document.addEventListener('DOMContentLoaded', index);

function index() {
  var themeSwitch = document.getElementById('themeSwitch');
  if (themeSwitch) {
    initTheme(); // on page load, if user has already selected a specific theme -> apply it

    themeSwitch.addEventListener('change', function (event) {
      resetTheme(); // update color theme
    });

  }
  renderCalendar();

  let openAddEventModalBtn = document.getElementById('open-addevent-modal');
  let addEventModal = new bootstrap.Modal(document.getElementById('add-event-modal'));

  if (openAddEventModalBtn) {
    openAddEventModalBtn.addEventListener('click', function () {
      addEventModal.show();
    });
  }

  let closeAddEventModalBtn = document.getElementById('close-addevent-modal');

  if (closeAddEventModalBtn) {
    closeAddEventModalBtn.addEventListener('click', function () {
      addEventModal.hide();
    });
  }
}

function initTheme() {
  var darkThemeSelected = (localStorage.getItem('themeSwitch') !== null && localStorage.getItem('themeSwitch') === 'dark');
  // update checkbox
  themeSwitch.checked = darkThemeSelected;
  // update body data-theme attribute
  darkThemeSelected ? document.body.setAttribute('data-theme', 'dark') : document.body.removeAttribute('data-theme');
};

function resetTheme() {
  if (themeSwitch.checked) { // dark theme has been selected
    document.body.setAttribute('data-theme', 'dark');
    localStorage.setItem('themeSwitch', 'dark'); // save theme selection 
  } else {
    document.body.removeAttribute('data-theme');
    localStorage.removeItem('themeSwitch'); // reset theme selection 
  }
};

function renderCalendar() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    timeZone: 'UTC',
    weekNumbers: true,
    firstDay: 1, // Monday
    initialView: 'timeGridWeek',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: 'https://fullcalendar.io/api/demo-feeds/events.json'
  });

  calendar.render();
}