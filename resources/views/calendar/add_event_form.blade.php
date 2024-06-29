<div class="modal fade" id="addeventmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&amp;times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="createEvent" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="title-group" class="form-group">
                                    <label class="control-label" for="title">Title</label>
                                    <input type="text" class="form-control" name="title">
                                    <!-- errors will go here -->
                                </div>
                                <div id="startdate-group" class="form-group">
                                    <label class="control-label" for="startDate">Start Date</label>
                                    <input type="date" class="form-control" id="startDate" name="startDate">
                                    <!-- errors will go here -->
                                </div>
                                <div id="enddate-group" class="form-group">
                                    <label class="control-label" for="endDate">End Date</label>
                                    <input type="date" class="form-control" id="endDate" name="endDate">
                                    <!-- errors will go here -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">All day</label>
                                    <!-- errors will go here -->
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->