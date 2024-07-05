<!-- Table for Calendar Entries -->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">User ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entries as $entry)
        <tr>
            <th scope="row">{{ $entry->id }}</th>
            <td>{{ $entry->title }}</td>
            <td>{{ $entry->description }}</td>
            <td>{{ $entry->category }}</td>
            <td>{{ $entry->start_date }}</td>
            <td>{{ $entry->end_date }}</td>
            <td>{{ $entry->user_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Table for Events -->
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
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
        <tr>
            <th scope="row">{{ $event->id }}</th>
            <td>{{ $event->title }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ $event->start_date }}</td>
            <td>{{ $event->end_date }}</td>
            <td>{{ $event->all_day }}</td>
            <td>{{ $event->user_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>