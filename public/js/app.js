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

$('#createEvent').submit(function (event) {

  // stop the form refreshing the page
  event.preventDefault();

  $('.form-group').removeClass('has-error'); // remove the error class
  $('.help-block').remove(); // remove the error text

  // process the form
  $.ajax({
    type: "POST",
    url: url + 'api/insert.php',
    data: $(this).serialize(),
    dataType: 'json',
    encode: true
  }).done(function (data) {

    // insert worked
    if (data.success) {

      //remove any form data
      $('#createEvent').trigger("reset");

      //close model
      $('#addeventmodal').modal('hide');

      //refresh calendar
      calendar.refetchEvents();

    } else {

      //if error exists update html
      if (data.errors.date) {
        $('#date-group').addClass('has-error');
        $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
      }

      if (data.errors.title) {
        $('#title-group').addClass('has-error');
        $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
      }

    }

  });
});

$('#editEvent').submit(function (event) {

  // stop the form refreshing the page
  event.preventDefault();

  $('.form-group').removeClass('has-error'); // remove the error class
  $('.help-block').remove(); // remove the error text

  //form data
  var id = $('#editEventId').val();
  var title = $('#editEventTitle').val();
  var start = $('#editStartDate').val();
  var end = $('#editEndDate').val();
  var color = $('#editColor').val();
  var textColor = $('#editTextColor').val();

  // process the form
  $.ajax({
    type: "POST",
    url: url + 'api/update.php',
    data: {
      id: id,
      title: title,
      start: start,
      end: end,
      color: color,
      text_color: textColor
    },
    dataType: 'json',
    encode: true
  }).done(function (data) {

    // insert worked
    if (data.success) {

      //remove any form data
      $('#editEvent').trigger("reset");

      //close model
      $('#editeventmodal').modal('hide');

      //refresh calendar
      calendar.refetchEvents();

    } else {

      //if error exists update html
      if (data.errors.date) {
        $('#date-group').addClass('has-error');
        $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
      }

      if (data.errors.title) {
        $('#title-group').addClass('has-error');
        $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
      }

    }

  });
});

// Open the add event modal when the button is clicked
$('.btn-add-event').on('click', function () {
  $('#add-event-modal').modal('show');
});

// Handle the form submission to add a new event
$('#add-event-form').submit(function (event) {
  event.preventDefault();
  // Send an AJAX request to store the new event
});