import './bootstrap';
"use strict";
let options = {
	events_source: 'events.json.php',
	view: 'month',
	tmpl_path: 'tmpls/',
	tmpl_cache: false,
	day: '2013-03-12',
	onAfterEventsLoad: function (events) {
		if (!events) {
			return;
		}
		let list = document.getElementById("eventlist");
		list.innerHTML = '';
		events.forEach(function (val, key) {
			let li = document.createElement('li');
			li.innerHTML = '<a href="' + val.url + '">' + val.title + '</a>'.appendTo(list);
		});
	},
	onAfterViewLoad: function (view) {
		document.querySelectorAll(".page-header h3").innerText = this.getTitle();
		document.querySelectorAll(".btn-group button").classList.remove("active");
		document.querySelectorAll('button[data-calendar-view="' + view + '"]').classList.add("active");
	},
	classes: {
		months: {
			general: 'label'
		}
	}
};
let calendar = document.getElementById("calendar").calendar(options);
document.querySelectorAll('.btn-group button[data-calendar-nav]').forEach(function () {
	let $this = this;
	$this.onclick = function () {
		calendar.navigate($this.data('calendar-nav'));
	};
});
document.querySelectorAll('.btn-group button[data-calendar-view]').each(function () {
	let $this = this;
	$this.onclick = function () {
		calendar.view($this.data('calendar-view'));
	};
});
document.getElementById("first_day").addEventListener("change", function () {
	let value = this.value;
	value = value.length ? parseInt(value) : null;
	calendar.setOptions({ first_day: value });
	calendar.view();
});
document.getElementById("language").addEventListener("change", function () {
	calendar.setLanguage(this.value);
	calendar.view();
});
document.getElementById("events-in-modal").addEventListener("change", function () {
	let val = document.getElementById("events-in-modal").checked ? this.value : null;
	calendar.setOptions({ modal: val });
});
document.getElementById("format-12-hours").addEventListener("change", function () {
	let val = document.getElementById("format-12-hours").checked;
	calendar.setOptions({ format12: val });
	calendar.view();
});
document.getElementById("show_wbn").addEventListener("change", function () {
	let val = document.getElementById("show_wbn").checked;
	calendar.setOptions({ display_week_numbers: val });
	calendar.view();
});
document.getElementById("show_wb").addEventListener("change", function () {
	let val = document.getElementById("show_wb").checked;
	calendar.setOptions({ weekbox: val });
	calendar.view();
});