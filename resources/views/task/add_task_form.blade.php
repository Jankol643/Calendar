<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="taskForm" method="POST" action="/tasks/add">
                    @csrf <!-- Laravel CSRF token for security -->

                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="Search categories...">
                        <select id="category-select" class="form-control" style="display:none;"></select>
                    </div>

                    <div class="form-group">
                        <label for="subcategory">Subcategory:</label>
                        <input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="Search subcategories...">
                        <select id="subcategory-select" class="form-control" style="display:none;"></select>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" class="form-control" id="due_date" name="due_date">
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration (in hours):</label>
                        <input type="number" class="form-control" id="duration" name="duration">
                    </div>

                    <div class="form-group">
                        <label for="prio">Priority (1-5):</label>
                        <input type="number" class="form-control" id="prio" name="prio" min="1" max="5">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</div>