@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-light">
            <!-- Calendar Selector -->
            <div id="calendar-selector">
                <div class="layout">
                    <h1>Custom Radio & Checkbox Input</h1>
                    <div class="list-btn">
                        <label class="radio-btn">
                            <input type="radio" checked>
                            <span></span>
                            Radio Input
                        </label>

                        <label class="checkbox-btn">
                            <input type="checkbox" checked>
                            <span></span>
                            Checkbox Input
                        </label>

                        <label class="switch-btn">
                            <input type="checkbox" checked>
                            <span></span>
                            Switch Button
                        </label>

                    </div>
                    <div class="switch">
                        <input class="switch__input" type="checkbox" id="themeSwitch">
                        <label aria-hidden="true" class="switch__label" for="themeSwitch">On</label>
                        <div aria-hidden="true" class="switch__marker"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div id="calendar"></div><br />
            <button type="button" class="btn btn-primary" id="openEventModalBtn">
                Add Event
            </button>
            <div id="dynamicFormContainer"></div>

            <button type="button" class="btn btn-primary" id="openTaskModalBtn">
                Add Task
            </button>
            @if (count($errors) > 0)
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#add-event-modal').modal('show');
                });
            </script>
            @endif

            <h1>Event list</h1>
            <br />
            @include('calendar.entry_list', ['events' => $events])

            <h1>Task list</h1>
            <br />
            @include('task.task_list', ['tasks' => $tasks])
        </div>
    </div>
</div>
@endsection