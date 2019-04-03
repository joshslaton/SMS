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

    function studentHasRecord($idnumber, $day){
        $db = new db();
        $q = "SELECT CONCAT(year(time_recorded),'-',month(time_recorded),'-',dayofmonth(time_recorded)) as DDATE, ";
        $q .= " SUM(if(direction='in',1,0)) as DIN,";
        $q .= " SUM(if(direction='in',0,1)) as DOUT,";
        $q .= " idnumber";
        $q .= " FROM gatekeeper_in";
        $q .= " WHERE idnumber=".$idnumber;
        $q .= " AND month(time_recorded)=month('".$day."')";
        $q .= " AND day(time_recorded)=day('".$day."')";
        $q .= " AND year(time_recorded)=year('".$day."')";
        $q .= " GROUP by DDATE, idnumber";
        $q .= " ORDER  BY DDATE ASC";
        $results = $db->query($q)->fetchAll();
        if($results == null){
          return "<td class='red'></td>";
        }
        else{
          // print("<br>");
          // print("dIN:".$results[0]["DIN"]." - dOUT: ".$results[0]["DOUT"]);
          if($results[0]["DIN"] == 1 && $results[0]["DOUT"] == 1)
            return "<td class='green'></td>";
          if($results[0]["DIN"] == 1 && $results[0]["DOUT"] == 0)
            return "<td class='yellow'></td>";
          if($results[0]["DIN"] == 0 && $results[0]["DOUT"] == 1)
            return "<td class='blue'></td>";
          // if($results[0]["DIN"] == 0 && $results[0]["DOUT"] == 0)
          //   return "<td class='red'></td>";
        }
    }

    function debug(){
      echo '<pre>';
      print_r($this->studentArray);
      echo '</pre>';
    }
}

// $student = new Student();
// $student -> init();
// $student -> debug();
?>
