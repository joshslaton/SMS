<?php
  include "./DB.inc.php";

  class Attendance {

  }

  class Student extends Attendance{

    function __construct(){
      $this->studentArray = Array();
    }

    function init(){
      // Initialize every student record with array
      $db = new db();
      $results = $db->query("SELECT idnumber FROM preschool WHERE idnumber")->fetchAll();
      foreach($results as $result){
        $id = $result["idnumber"];
        print("Student ID: ");
        print($id);
        $this->studentArray[$id]["time_in"] = Array();
        $this->studentArray[$id]["time_out"] = Array();
        $this->insertTimeRecord($id);
        $this->printRecord($id);
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

    function printRecord($idnumber){
      foreach($this->studentArray[$idnumber]["time_in"] as $k=>$v){
        print("<br>");
        print($v);
      }

      foreach($this->studentArray[$idnumber]["time_out"] as $k=>$v){
        print("<br>");
        print($v);
      }

      print("<br>");
      print("-------------------");
      print("<br><br><br>");

    }
}

$student = new Student();

$student -> init();
?>
