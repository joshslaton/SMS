<?php
include "./student.php";

$student = new Student();
$student -> init();
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
  <table class="table">
    <thead>
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
        foreach($student->studentArray as $idnumber=>$attendance){
          echo "<tr>";
          echo "<td>".$idnumber."</td>";
          for($i = 1; $i <= 31; $i++){
              if($student->isStudentPresent($idnumber, $i)){
                echo "<td class='green'>";
                echo "</td>";
              }
              else{
                echo "<td class='red'>";
                echo "</td>";
              }
          }
          echo "</tr>";
        }
        ?>
        <tr>
    </thead>
  </table>
</body>
</html>
