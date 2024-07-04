<div class="modal fade" id="add-event-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form id="add-event-form" class="form-horizontal" method="POST" action="/event/create">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div id="title-group" class="form-group">
                                    <label class="control-label" for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                    @foreach ($errors->get('title') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                                <div id="startdate-group" class="form-group">
                                    <label class="control-label" for="start_date">Start Date</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                    @if ($errors->has('start_date'))
                                    @foreach ($errors->get('start_date') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                                <div id="starttime-group" class="form-group">
                                    <label class="control-label" for="start_time">Start Time</label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}">
                                    @if ($errors->has('start_time'))
                                    @foreach ($errors->get('start_time') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                                <div id="enddate-group" class="form-group">
                                    <label class="control-label" for="end_date">End Date</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                    @if ($errors->has('end_date'))
                                    @foreach ($errors->get('end_date') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                                <div id="endtime-group" class="form-group">
                                    <label class="control-label" for="end_time">End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time">
                                    @if ($errors->has('end_time'))
                                    @foreach ($errors->get('end_time') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                                <div id="description-group" class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                    @if ($errors->has('description'))
                                    @foreach ($errors->get('description') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="all_day" name="all_day">
                                    <label class="form-check-label" for="all_day">All day</label>
                                    @if ($errors->has('all_day'))
                                    @foreach ($errors->get('all_day') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                                <div id="category-group" class="form-group">
                                    <label class="control-label" for="category">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Select Category</option>
                                        <option value="Meeting">Meeting</option>
                                        <option value="Event">Event</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    @if ($errors->has('category'))
                                    @foreach ($errors->get('category') as $message)
                                    <span>{{ $message }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-add-event">Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->