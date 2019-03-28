<?php
  include "./DB.inc.php";

  class Student{

    // public $record = Array();
    public $idnumber = Array(
      "2900876" => Array(
        "name" => "Alec Joshua Slaton",
        "course" => "BA Accountancy",
        "year" => "1",
        "time_records" => Array(
          "time_in" => "2019-03-27 08:00:00",
          "time_out" => "2019-03-27 17:00:00"
          )
        )
    );

    function init(){
      $db = new db();
      if($results = $db->query("SELECT idnumber, time_recorded, direction FROM gatekeeper_in WHERE idnumber = 1700389")->fetchAll()){
        foreach($results as $result){
          // array_push($this->record, $result["idnumber"]);
        }
      }

    }

  } // End of Student Class

  $student = new Student();
  $student->init();
?>
<html>
<head>
  <title>Monitoring</title>
</head>
<body>
  <table border="1">
    <!-- TABLE HEAD -->
    <thead>
    <tr>
      <td>Student Name</td>
      <td>Date</td>
    </tr>
    <!-- TABLE SECOND ROW -->
    <!-- PHP CODE HERE -->
    <?php
    foreach($student->idnumber as $id=>$info){
    echo "<tr>";
      echo "<td>".$id."</td>";
      echo "<td>";
        echo "<table>";
          echo "<thead>";
          foreach($info as $entry){
            var_dump($entry);
            echo "<tr>";
              echo "<td>".$info["time_records"]["time_in"]."</td>";
              echo "<td>".$info["time_records"]["time_out"]."</td>";
            echo "</tr>";
          }
          echo "</thead>";
        echo "</table>";
      echo "</td>";
    echo "</tr>";
    }
    ?>



  </thead>
  <tbody>
  </tbody>
  </table>
</body>
</html>
