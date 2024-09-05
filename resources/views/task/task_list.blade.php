@include('task.delete_task_confirmation')
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Due date</th>
            <th scope="col">Duration</th>
            <th scope="col">Priority</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <th scope="row">{{ $task->id }}</th>
            <td>{{ $task->name }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->category }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->duration }}</td>
            <td>{{ $task->priority }}</td>
            <td>
                <button data-bs-toggle="modal" data-bs-target="#addTaskModal" data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                    <i class="bi bi-eye"></i>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#editTaskModal" data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                    <i class="bi bi-pencil"></i>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#deleteTaskModal" data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>