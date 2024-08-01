<div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&amp;times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="editEvent" class="form-horizontal">
                        <input type="hidden" id="editEventId" name="editEventId" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="edit-title-group" class="form-group">
                                    <label class="control-label" for="editEventTitle">Title</label>
                                    <input type="text" class="form-control" id="editEventTitle" name="editEventTitle">
                                    <!-- errors will go here -->
                                </div>
                                <div id="edit-startdate-group" class="form-group">
                                    <label class="control-label" for="editStartDate">Start Date</label>
                                    <input type="date" class="form-control" id="editStartDate" name="editStartDate">
                                    <!-- errors will go here -->
                                </div>
                                <div id="edit-enddate-group" class="form-group">
                                    <label class="control-label" for="editEndDate">End Date</label>
                                    <input type="date" class="form-control" id="editEndDate" name="editEndDate">
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
                <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->