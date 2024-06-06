import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'

document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('calendar')
  const calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin],
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    }
  })
  calendar.render()
});

document.addEventListener('DOMContentLoaded', function() {
  let checkboxes = document.querySelectorAll('.calendar-checkbox');
  
  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
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