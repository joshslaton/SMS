<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' type='text/javascript'></script>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js' type='text/text/javascript'></script>
    <script src='/scripts.js'></script>
    <link href='/style.css' rel='stylesheet'>
  </head>
  <body>
    <?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); ?>
    <!-- Removed because the dropdown menu is inside a div not showing the full content -->
    <!-- <div class='nav-sub-container'> -->
      <div class='dropdown'>
        <div>
        <ul id='nav-sub'>
          <li><a id='attendance' href='#'>Attendance</a></li>
        </ul>
        </div>
        <div class='dropdown-content'>
          <a href='http://localhost/reports/attendance/student/' id='reports-category-bystudent'>By Student</a>
          <!-- <a href='http://localhost/reports/attendance/grade/' id='reports-category-bygrade'>By Grade</a> -->
          <a href='http://localhost/reports/attendance/section/' id='reports-category-bysection'>By Section</a>
        </div>
      </div>
    <!-- </div> -->
    <div class='content-wrapper'>

    </div>
  </body>
</html>
