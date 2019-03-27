<?php
  include "../../includes/DB.inc.php";

  class Student{

    // $db = new DB("192.168.8.222","kiosk","kiosk","preschool_gatekeeper");
    public $record = Array();

    function __construct(){

    }

    function init(){
      $db = new db();
      if($results = $db->query("SELECT idnumber FROM preschool WHERE idnumber = 2900876")->fetchAll()){
        foreach($results as $result){
          array_push($this->record, $result);
        }
      }

    }

  } // End of Student Class

  $student = new Student();
  $student->init();
  var_dump($this->record);

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
    <tr>
      <?php
      echo "<td>STUDENT NAME</td>";
      ?>
      <td>
        <table>
          <thead>
            <tr>
              <td>In</td>
              <td>Out</td>
            </tr>
          </thead>
        </table>
      </td>
    </tr>



  </thead>
  <tbody>
  </tbody>
  </table>
</body>
</html>
