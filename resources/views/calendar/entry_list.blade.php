@include('calendar.delete_event_confirmation')
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">All Day</th>
            <th scope="col">User ID</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
        <tr>
            <th scope="row">{{ $event->id }}</th>
            <td>{{ $event->title }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d H:i') }}</td>
            <td>{{ $event->all_day ? 'Yes' : 'No' }}</td>
            <td>{{ $event->user_id }}</td>
            <td>
                <button data-bs-toggle="modal" data-bs-target="#addEventModal" data-event-id="{{ $event->id }}" data-event-title="{{ $event->title }}">
                    <i class="bi bi-eye"></i>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#editEventModal" data-event-id="{{ $event->id }}" data-event-title="{{ $event->title }}">
                    <i class="bi bi-pencil"></i>
                </button>
                <a href="{{ route('events.edit', $event->id) }}"></a>
                <button data-bs-toggle="modal" data-bs-target="#deleteEventModal" data-event-id="{{ $event->id }}" data-event-title="{{ $event->title }}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>