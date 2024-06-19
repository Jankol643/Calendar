<form action="/add-event" method="POST">
    <div class="mb-3">
        <label for="event-name" class="form-label">Event Name</label>
        <input type="text" class="form-control" id="event-name" name="event-name" required>
    </div>
    <div class="mb-3">
        <label for="event-date" class="form-label">Event Date</label>
        <input type="date" class="form-control" id="event-date" name="event-date" required>
    </div>
    <div class="mb-3">
        <label for="event-time" class="form-label">Event Time</label>
        <input type="time" class="form-control" id="event-time" name="event-time" required>
    </div>
    <div class="mb-3">
        <label for="event-description" class="form-label">Event Description</label>
        <textarea class="form-control" id="event-description" name="event-description" rows="3"></textarea>
    </div>
</form>