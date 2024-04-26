document.addEventListener('DOMContentLoaded', function () {
	let calendarEl = document.getElementById('calendar');
	let calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		initialDate: '2024-03-07',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay'
		},
		events: 'events.json'
	});
	calendar.render();
});