<?php
  include "./DB.inc.php";
  include "./calendar.php";
  class Student {
    function __construct(){
      $this->db = new db();
      $this->cal = new Calendar();
      $this->studentArray = Array();
    }

    function init(){
      // Initialize every student record with array
      $results = $this->db->query("SELECT idnumber FROM preschool WHERE idnumber")->fetchAll();
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
      if($results = $this->db->query("SELECT * FROM preschool WHERE idnumber = ".$idnumber)->fetchAll()){
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
      $results = $this->db->query("SELECT direction, time_recorded FROM gatekeeper_in WHERE idnumber=".$idnumber)->fetchAll();
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
        $results = $this->db->query($q)->fetchAll();
        // print("<pre>");
        // print_r($results);
        // print("</pre>");
        if($results == null){ // no record
          if(!$this->cal->isWeekend($day)){ // not weekend
            if(!$this->cal->isHoliday($day)) // not holiday
              return "<td class='tDay'>".date("d", strtotime($day))."</td>";
            else // holiday
              return "<td class='tDay cyan'>".date("d", strtotime($day))."</td>";

          }
          else{
            // if weekend
            if(!$this->cal->isHoliday($day))
              return "<td class='red tDay'>".date("d", strtotime($day))."</td>";
            else
              return "<td class='cyan tDay'>".date("d", strtotime($day))."</td>";
          }
        }
        else{

          if(!$this->cal->isHoliday($day)){
            if($results[0]["DIN"] >= 1 && $results[0]["DOUT"] >= 1)
              return "<td class='green tDay'>".date("d", strtotime($day))."</td>";
            if($results[0]["DIN"] >= 1 && $results[0]["DOUT"] == 0)
              return "<td class='yellow tDay'>".date("d", strtotime($day))."</td>";
            if($results[0]["DIN"] == 0 && $results[0]["DOUT"] >= 1)
              return "<td class='blue tDay'>".date("d", strtotime($day))."</td>";
          }else{
            return "<td class='cyan>".date("d", strtotime($day))."</td>";
          }
        }
    }

    function debug(){
      echo '<pre>';
      print_r($this->studentArray);
      echo '</pre>';
    }

    function getSections(){
      $sec = Array();
      if($results = $this->db->query("SELECT DISTINCT grade FROM preschool")->fetchAll()){
        foreach($results as $result){
          array_push($sec, $result);
        }
        return $sec;
      }
    }

    function getGradeLevel() {
      $gradeLevel = Array();
      if($results = $this->db->query("SELECT DISTINCT grade FROM preschool")->fetchAll()){
        foreach($results as $result){
          if(!$result["grade"] == ""){
            array_push($gradeLevel, $result["grade"]);
          }
        }

      }
      return $gradeLevel;
    }

    function getSection($gradeLevel) {
      $section = Array();
      if($results = $this->db->query("SELECT DISTINCT section FROM preschool WHERE grade='".$gradeLevel."'")->fetchAll()){
        foreach($results as $result){
          if(!$result["section"] == ""){
            array_push($section, $result["section"]);
          }
        }
      return $section;
      }
    }

    function getGender() {
      $gender = Array();
      $q = "SELECT DISTINCT IF(gender='m','Male','Female') AS gender FROM preschool";
      if($results = $this->db->query($q)->fetchAll()){
        foreach($results as $result){
          array_push($gender, $result);
        }
      return $gender;
      }
    }

    function getDates(){
      $dates = Array();
      $q = "SELECT DISTINCT CONCAT(year(time_recorded),'-',month(time_recorded)) as date FROM gatekeeper_in";
      if($results = $this->db->query($q)->fetchAll()){
        foreach($results as $result){
          array_push($dates, $result);
        }
      }
      return $dates;
    }
}

// $student = new Student();
// $student -> init();
// $student -> debug();
?>
