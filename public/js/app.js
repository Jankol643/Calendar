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

  initEventDelete();
  initTaskModal();
  initDeleteTaskModal();
  initEventModal();
}

function initEventDelete() {
  let deleteEventModal = document.getElementById('deleteEventModal');
  deleteEventModal.addEventListener('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var eventId = button.data('event-id'); // Extract event ID from data attribute
    var eventTitle = button.closest('tr').find('td:eq(1)').text(); // Extract event title from table row

    var modal = $(this);
    modal.find('#eventId').text('Event ID: ' + eventId); // Update the event ID in the modal
    modal.find('#eventTitle').text('Event Title: ' + eventTitle); // Update the event title in the modal


    // Update the form action URL
    const form = document.getElementById('deleteEventForm');
    form.action = `/events/delete/${eventId}`;
  });
}

function initTaskModal() {
  let openTaskModalBtn = document.getElementById('openTaskModalBtn');

  if (openTaskModalBtn) {
    openTaskModalBtn.addEventListener('click', function () {
      // Fetch the form HTML from the PHP file
      fetch('/task/add_task_form')
        .then(response => response.text())
        .then(html => {
          // Create a temporary container for the HTML
          const tempDiv = document.createElement('div');
          tempDiv.innerHTML = html;

          // Append the modal to the body
          document.body.appendChild(tempDiv);

          var addTaskModal = new bootstrap.Modal(document.getElementById('addTaskModal'));
          addTaskModal.show();

          // Add event listener to the close button
          document.getElementById('closeAddTaskForm').onclick = function () {
            document.body.removeChild(tempDiv); // Remove the modal from the DOM
          };

          // Handle form submission
          document.getElementById('addTaskForm').onsubmit = function (event) {
            event.preventDefault(); // Prevent default form submission
            // Here you can handle the form data as needed
            alert('Task added: ' + document.getElementById('taskName').value);
            document.body.removeChild(tempDiv); // Remove the modal from the DOM
          };
        })
        .catch(error => console.error('Error fetching the form:', error));
    });
  }
}

function initDeleteTaskModal() {
  let deleteTaskModal = document.getElementById('deleteTaskModal');
  deleteTaskModal.addEventListener('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var taskId = button.data('task-id'); // Extract task ID from data attribute
    var eventTitle = button.closest('tr').find('td:eq(1)').text(); // Extract task title from table row

    var modal = $(this);
    modal.find('#taskId').text('Task ID: ' + taskId); // Update the task ID in the modal
    modal.find('#taskTitle').text('Task Title: ' + taskTitle); // Update the task title in the modal



    // Update the form action URL
    const form = document.getElementById('deleteTaskForm');
    form.action = `/tasks/delete/${taskId}`;
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
    return;
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

function initEventModal() {
  document.getElementById('openAddEventModalBtn').addEventListener('click', function () {
    // Fetch the calendars from the server
    fetch('/calendars')
      .then(response => response.json())
      .then(calendars => {
        // Create a request to get the form HTML
        return fetch('/add-event-form');
      })
      .then(response => response.text())
      .then(html => {
        // Populate the modal body with the form HTML
        document.getElementById('dynamicFormContainer').innerHTML = html;

        // Show the modal using Bootstrap's modal method
        var modalElement = document.getElementById('addEventModal');
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
      })
      .catch(error => console.error('Error fetching the form:', error));
  });
}

