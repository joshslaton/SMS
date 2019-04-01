<?php
  include "./DB.inc.php";

  class Student {

    function __construct(){
      $this->studentArray = Array();
    }

    function init(){
      // Initialize every student record with array
      $db = new db();
      $results = $db->query("SELECT idnumber FROM preschool WHERE idnumber")->fetchAll();
      foreach($results as $result){
        $id = $result["idnumber"];
        // print("Student ID: ");
        // print($id);
        $this->studentArray[$id]["time_in"] = Array();
        $this->studentArray[$id]["time_out"] = Array();
        $this->insertTimeRecord($id);
      }
    }

    function insertTimeRecord($idnumber){
      $db = new db();
      $results = $db->query("SELECT direction, time_recorded FROM gatekeeper_in WHERE idnumber=".$idnumber)->fetchAll();
      foreach($results as $result){
        if($result["direction"] == "in"){
          array_push($this->studentArray[$idnumber]["time_in"], $result["time_recorded"]);
        }
        if($result["direction"] == "out"){
          array_push($this->studentArray[$idnumber]["time_out"], $result["time_recorded"]);
        }
      }
    }

    // Add day to parameters, add date later on
    function isStudentPresent($idnumber, $day){
      $today = date("Y-m-d", strtotime("2019-03-".$day));
      // Check in the array of student
      // echo "<pre>";
      foreach($this->studentArray[$idnumber] as $k=>$v){
        if($k == "time_in"){
          foreach($v as $timeEntry){ // Check each time entry
            if(date("Y-m-d", strtotime($timeEntry)) == $today){
              return True;
            }
          }
        }
        // print_r($this->studentArray[$idnumber]["time_in"]);
      }
      // echo "</pre>";
    }

    function debug(){
      echo '<pre>';
      print_r($this->studentArray);
      echo '</pre>';
    }
}

$student = new Student();
$student -> init();
// $student -> debug();
?>
