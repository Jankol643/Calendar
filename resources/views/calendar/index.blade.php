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
            <div id="calendar"></div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal">
                Edit Task
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                Add Event
            </button>
        </div>
    </div>
</div>
@endsection