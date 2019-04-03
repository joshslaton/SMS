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
        $this->studentInfoToArray($id);
        $this->studentArray[$id]["time_in"] = Array();
        $this->studentArray[$id]["time_out"] = Array();
        $this->studentTimeRecordToArray($id);

      }
    }

    function studentInfoToArray($idnumber){
      $db = new db();
      if($results = $db->query("SELECT * FROM preschool WHERE idnumber = ".$idnumber)->fetchAll()){
        foreach($results as $result){
          $this->studentArray[$idnumber]["name"] = $result["name"];
          $this->studentArray[$idnumber]["grade"] = $result["grade"];
          $this->studentArray[$idnumber]["course"] = $result["course"];
          $this->studentArray[$idnumber]["section"] = $result["section"];
          $this->studentArray[$idnumber]["year"] = $result["year"];
        }
      }
    }

    function studentTimeRecordToArray($idnumber){
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
      $today = date("Y-m-d", strtotime("2019-04-".$day));
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

    function studentHasInRecord($idnumber, $day){
      // 2 = in & out, // 1 = in // 0 = none of the above
      // $today = date("Y-m-d", strtotime("2019-04-".$day));
      // echo "<pre>";
      foreach($this->studentArray[$idnumber] as $direction=>$time){
        $today = date("Y-m-d", strtotime("2019-04-".$day));
        // If student has time in based on the date given
        if($direction == "time_in"){
          foreach($time as $timeEntry=>$v){
            if(date("Y-m-d", strtotime($v)) == $today){
              // return 1;
              return $this->studentHasOutRecord($idnumber, $day);
            }
          }
        }
      }
      // echo "</pre>";
    }

    function studentHasOutRecord($idnumber, $day){
      foreach($this->studentArray[$idnumber] as $direction=>$time){
        $today = date("Y-m-d", strtotime("2019-04-".$day));
        if($direction == "time_out"){
          foreach($time as $timeEntry=>$v){
            if(date("Y-m-d", strtotime($v)) == $today){
              return 2;
            }else{
              return 1;
            }
          }
        }
      }
    }

    function debug(){
      echo '<pre>';
      print_r($this->studentArray);
      echo '</pre>';
    }
}

$student = new Student();
$student -> init();
$student -> debug();
?>
