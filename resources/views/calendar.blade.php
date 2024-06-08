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

  @vite(['resources/sass/calendar.scss','resources/css/app.css'])
  @vite(['resources/js/app.js'])
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
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
         <!-- 
        <div id="calendar-view">
          <div class="mt-5 w-full p-2 rounded-xl big-calendar">
            <div>
              <div class="grid grid-cols-7 day-row">
                <div class="big-date" style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">Su</span></div>
                <div class="big-date"><span class="big-date-cell">Mo</span></div>
                <div class="big-date"><span class="big-date-cell">Tu</span></div>
                <div class="big-date"><span class="big-date-cell">We</span></div>
                <div class="big-date"><span class="big-date-cell">Th</span></div>
                <div class="big-date"><span class="big-date-cell">Fr</span></div>
                <div class="big-date" style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">Sa</span></div>
              </div>
              <div class="grid grid-cols-7 grid-rows-6">
                <div class="big-date py-1  " style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">26</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">27</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">28</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">29</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">30</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">31</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">1</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">2</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">3</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">4</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">5</span>
                  <div class="event-list">
                    <div>
                      <div class="event-name" style="background: rgb(116, 128, 166);">asdf</div>
                    </div>
                  </div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">6</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">7</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 today " style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">8</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">9</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">10</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">11</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">12</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">13</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">14</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">15</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">16</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">17</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">18</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">19</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">20</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">21</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">22</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">23</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">24</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">25</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">26</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">27</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month "><span class="big-date-cell">28</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">29</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1 current-month " style="background: rgba(90, 163, 255, 0.15);"><span class="big-date-cell">30</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">1</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">2</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">3</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">4</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  "><span class="big-date-cell">5</span>
                  <div class="event-list"></div>
                </div>
                <div class="big-date py-1  " style="background: rgba(255, 77, 77, 0.15);"><span class="big-date-cell">6</span>
                  <div class="event-list"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
-->
        <div id="calendar"></div>
      </div>
    </div>
  </div>
</body>

</html>