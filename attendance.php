<?php
// https://stackoverflow.com/questions/14080049/jquery-changing-value-binding-in-database-with-ajax-mysql
include "./student.php";

$student = new Student();
$student -> init();

// Should be in calendar class
$m = "3";
$dom = date("t", mktime(0, 0, 0, $m, 1));
?>

<html>

<head>
  <link href="./style.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/text/javascript"></script>
  <script src="./scripts.js"></script>
</head>
<body>
  <form>
    <div class="radio">
      <?php
        $sec = $student->getSections();
        foreach($sec as $sections){
          echo "<label><input type='radio' name='optradio' value='".$sections["grade"]."'>".$sections["grade"]."</label><br>";
        }
      ?>
    </div>
  <table class="table">
      <!--  PUT THIS IN A FUNCTION -->
      <tr class="tableHead">
        <td>Month Label</td>
        <?php
          for($i = 1; $i <= $dom; $i++){
            echo "<td class='tDay'>".$i."</td>";
          }
        ?>
        <td></td>
      </tr>
      <tr class="tableHead">
        <td></td>
        <?php
          for($i = 1; $i <= $dom; $i++){
            echo "<td class='tDay'>".date("D", mktime(0, 0, 0, $m, $i))."</td>";
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
        // TODO: Sort male and female
        if($results = $db->query("SELECT idnumber, name, grade FROM preschool")->fetchAll()){
          foreach($results as $result){
            if($result["grade"] == ""){
              echo "<tr>";
              echo "<td class='tdStudent'>".$result["idnumber"]."<br>".$result["name"]."</td>";
              // Check each day of month if student has time record in it
              for($i=1; $i<=$dom; $i++){
                print($student->studentHasRecord($result["idnumber"],"2019-".$m."-".$i));
              }
            }
          }
        }
        ?>
        <tr>
    </thead>
  </table>
  <form>
</body>
</html>
