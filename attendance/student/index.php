<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' type='text/javascript'></script>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js' type='text/text/javascript'></script>
    <script src='scripts.js'></script>
    <link href='style.css' rel='stylesheet'>
  </head>
  <body>
    <div class='nav-main-container'>
      <ul id='nav-main'>
        <li id='nav-home'><a href='../'>Home</a></li>
        <li id='nav-students'><a href='#'>Students</a></li>
        <li><a href='#'>Users</a></li>
        <li><a href='#'>Schedule</a></li>
        <li id='nav-reports'><a href='#'>Reports</a></li>
      </ul>
    </div>
    <div class='nav-sub-container'>
      <ul id='nav-sub'>
        <li><a href='#'>Student Info</a></li>
        <li><a href='#'>Add Student</a></li>
        <!-- <li><a href='#'>Students</a></li>
        <li><a href='#'>Users</a></li>
        <li><a href='#'>Schedule</a></li>
        <li><a href='#'>Reports</a></li> -->
      </ul>
    </div>
    <div class='content-wrapper'>
      <div><p id='status'>Status</p></div>
      <!-- TODO: Search student by name or student id -->
      <div class='content-search'>
        <label>
          Student ID:
          <input type='text' id='enterStudentID'>
        </label>
        <!-- BETTER NAMES -->
        <input type='button' id='searchProfile' class='btn btn-success' value='Submit'>
      </div>
      <div id='searchResults'>
      </div>
      <div id='profileResult'>
        <div id='frameOuter'>
          <div id='frameInner'>
            Display None
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
