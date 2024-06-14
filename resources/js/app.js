import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

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
  let calendarEl = document.getElementById('calendar');
  let calendar = new Calendar(calendarEl, {
    timeZone: 'UTC',
    plugins: [dayGridPlugin],
    initialView: 'dayGridYear',
    headerToolbar: {
      left: 'prev,next',
      center: 'title',
      right: 'dayGridYear,dayGridWeek,dayGridDay'
    },
    editable: true
  });
  calendar.render();
};

document.addEventListener('DOMContentLoaded', function () {
  let checkboxes = document.querySelectorAll('.calendar-checkbox');

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      let calendarId = this.id;
      let isChecked = this.checked;

      // Send an AJAX request or perform any other logic based on the checkbox change
      // Example: Toggle the visibility of the calendar based on the checkbox status
      if (isChecked) {
        document.getElementById(calendarId).style.display = 'block';
      } else {
        document.getElementById(calendarId).style.display = 'none';
      }
    });
  });
});