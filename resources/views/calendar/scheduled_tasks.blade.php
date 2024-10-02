@extends('layouts.app')

@section('content')
@if($scheduledTasks->isNotEmpty())
<h2>Scheduled Tasks</h2>
<ul>
    @foreach($scheduledTasks as $scheduledTask)
    <li>
        Task: {{ $scheduledTask->task->name }}<br>
        Start Time: {{ $scheduledTask->startTime }}<br>
        End Time: {{ $scheduledTask->endTime }}
    </li>
    @endforeach
</ul>
@else
<p>No tasks could be scheduled.</p>
@endif