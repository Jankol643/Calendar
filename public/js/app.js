document.addEventListener('DOMContentLoaded', index);

function index() {
  let themeSwitch = document.getElementById('themeSwitch');
  if (themeSwitch) {
    initTheme(themeSwitch); // on page load, if user has already selected a specific theme -> apply it

    themeSwitch.addEventListener('change', function (event) {
      resetTheme(themeSwitch); // update color theme
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

  let deleteEventModal = document.getElementById('deleteEventModal');
  deleteEventModal.addEventListener('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var eventId = button.data('event-id'); // Extract event ID from data attribute
    var eventTitle = button.closest('tr').find('td:eq(1)').text(); // Extract event title from table row

    var modal = $(this);
    modal.find('#eventId').text('Event ID: ' + eventId); // Update the event ID in the modal
    modal.find('#eventTitle').text('Event Title: ' + eventTitle); // Update the event title in the modal

    // Update the form action with the event ID
    var form = modal.find('form');
    var deleteUrl = form.attr('action');
    deleteUrl = deleteUrl.replace(':event', eventId);
    form.attr('action', deleteUrl);
  });
}

function initTheme(themeSwitch) {
  let darkThemeSelected = (localStorage.getItem('themeSwitch') !== null && localStorage.getItem('themeSwitch') === 'dark');
  // update checkbox
  themeSwitch.checked = darkThemeSelected;
  // update body data-theme attribute
  darkThemeSelected ? document.body.setAttribute('data-theme', 'dark') : document.body.removeAttribute('data-theme');
};

function resetTheme(themeSwitch) {
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
  if (!calendarEl) {
    console.error("Calendar element not found!");
    return; // Exit the function if the element is not found
  }

  let calendar = new FullCalendar.Calendar(calendarEl, {
    timeZone: 'UTC',
    weekNumbers: true,
    firstDay: 1, // Monday
    initialView: 'timeGridWeek',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: '/api/events'
  });

  calendar.render();
}