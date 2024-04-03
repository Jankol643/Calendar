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
let calendar = document.getElementById("calendar").calendar(options); $('.btn-group button[data-calendar-nav]').each(function () {
	let $this = this;
	$this.click(function () {
		calendar.navigate($this.data('calendar-nav'));
	});
});
document.querySelectorAll('.btn-group button[data-calendar-view]').each(function () {
	let $this = this;
	$this.click(function () {
		calendar.view($this.data('calendar-view'));
	});
});
document.getElementById("first_day").change(function () {
	let value = this.value;
	value = value.length ? parseInt(value) : null;
	calendar.setOptions({ first_day: value });
	calendar.view();
});
document.getElementById("language").change(function () {
	calendar.setLanguage(this.value);
	calendar.view();
});
document.getElementById("events-in-modal").change(function () {
	let val = this.is(':checked') ? this.value : null;
	calendar.setOptions({ modal: val });
});
document.getElementById("format-12-hours").change(function () {
	let val = this.is(':checked') ? true : false;
	calendar.setOptions({ format12: val });
	calendar.view();
});
document.getElementById("show_wbn").change(function () {
	let val = this.is(':checked') ? true : false;
	calendar.setOptions({ display_week_numbers: val });
	calendar.view();
});
document.getElementById("show_wb").change(function () {
	let val = this.is(':checked') ? true : false;
	calendar.setOptions({ weekbox: val });
	calendar.view();
});
document.querySelectorAll('#events-modal .modal-header, #events-modal .modal-footer').click(function (e) {
});