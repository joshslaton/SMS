<?php
include "./student.php";

$student = new Student();
$student -> init();
// exit(0);
// print_r($student-> studentHasInRecord("2900876", "2019-4-1"));
?>
<html>

<head>
  <link href="./style.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/text/javascript"></script>
</head>
<body>
  <!-- <label>Date: </label><input type="text"/><button class="btn btn-primary">Go</button> -->
  <table class="table">
      <tr>
        <td>Month Label</td>
        <?php
          for($i = 1; $i <= 31; $i++){
            echo "<td>".$i."</td>";
          }
        ?>
        <td></td>
      </tr>
      <!-- <tr>
        <td>Student</td>
      </tr> -->
        <?php
        // TODO: Remove student array
        $db = new db();
        if($results = $db->query("SELECT idnumber FROM preschool")->fetchAll()){
          foreach($results as $result){
            echo "<tr>";
            echo "<td>".$result["idnumber"]."</td>";
            // Check each day of month if student has time record in it
            for($i=1; $i<=31; $i++){
              print($student->studentHasRecord($result["idnumber"],"2019-3-".$i));
            }
          }
        }
        ?>
        <tr>
    </thead>
  </table>
</body>
</html>
