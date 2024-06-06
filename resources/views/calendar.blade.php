<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar App</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/calendar.css') }}" type="text/css">

  <script type='importmap'>
    {
        "imports": {
          "@fullcalendar/core": "https://cdn.skypack.dev/@fullcalendar/core@6.1.14",
          "@fullcalendar/daygrid": "https://cdn.skypack.dev/@fullcalendar/daygrid@6.1.14"
        }
      }
    </script>
</head>

<body>
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
</div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Calendar View -->
        <div id="calendar-view">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>
  <script type="module" src="{{asset('js/app.js')}}"></script>
</body>

</html>