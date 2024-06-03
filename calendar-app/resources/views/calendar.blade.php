<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar App</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS -->
  <script src="scripts.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div>
        <a href="toggleMode()">
      </div>
      <!-- Sidebar -->
      <div class="col-md-3 bg-light">
        <!-- Calendar Selector -->
        <div id="calendar-selector">
          <!-- Add your calendar selector code here -->
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Calendar View -->
        <div id="calendar-view">
          <!-- Add your calendar view code here -->
        </div>
      </div>
    </div>
  </div>
</body>

</html>