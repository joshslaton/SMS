<?php
include_once $_SERVER['DOCUMENT_ROOT'].'includes/DB.inc.php';

class calendar {
  private $schoolYear = Array(
    "start"=>"2018-08-13",
    "end"=>"2019-05-31"
  );

  private $holidays = Array(
    "January" => Array(1 => "New Year"),
    "February" => Array(5 => "Chinese New Year", 25 => "EDSA Revolution"),
    "April" => Array(18 => "Maundy Thursday", 19 => "Good Friday", 20 => "Black Saturday"),
    "May" => Array(1 => "Labor Day"),
    "June" => Array(12 => "Independence Day"),
    "August" => Array(21 => "Ninoy Aquino Day", 26 => "National Heroes Day"),
    "November" => Array(1 => "All Saints Day", 2 => "All Souls Day", 30 => "Bonifacio Day"),
    "December" => Array(8 => "Feast of Immaculate Conception", 25 => "Christmas Day", 31 => "Last Day of the Year"));

  function __construct(){
    $this->db = new db();
  }

  // TODO: Too many loops ? Not effiient ?
  function isHoliday($date){
    foreach($this->holidays as $month => $day){
      foreach($day as $d => $label){
        if($month == date("F", strtotime($date))){
          if($d == date("j", strtotime($date))){
            // echo "Holiday: $d - $label<br>";
            return True;
          }
        }
      }
    }
  }

  function daysInMonth($m){
    return date("t", mktime(0, 0, 0, $m, 1));
  }

  // Accepts "Y-m-d"
  function monthsToIterate($startDate, $endDate){
      $monthsToIterate = Array();
      $mStart = date("n", strtotime($startDate));
      $mEnd = date("n", strtotime($endDate));

      if($mStart > $mEnd){
        for($i=$mStart; $i<=12; $i++){
          array_push($monthsToIterate, $i);
        }
        for($j=1; $j<=$mEnd; $j++){
          array_push($monthsToIterate, $j);
        }
      }
      return $monthsToIterate;
  }
  function isWeekend($date){
    if(date("N", strtotime($date)) == 6 || date("N", strtotime($date)) == 7)
      return True;
  }

  function numberOfSchoolDays($startDate, $endDate){
    $schoolDays = abs(strtotime($startDate) - strtotime($endDate));
    $schoolDays = $schoolDays / ( 60 * 60 * 24 );
    // $db = new db("localhost","kiosk","kiosk","school");
    foreach($this->monthsToIterate($this->schoolYear["start"], $this->schoolYear["end"]) as $m){
      for($i=1; $i <= $this->daysInMonth($m); $i++){
        if($this->isHoliday("2019-$m-$i") || $this->isWeekend("2019-$m-$i")){
          $schoolDays -= 1;
        }
      }
    }
    return $schoolDays;
  }



  function numberOfDaysPresent($studentID){
    $present = 0;
    $absent = 0;
    $results = $this->db->query("SELECT `time_recorded` FROM gatekeeper_in WHERE idnumber='".$studentID."'")->fetchAll();

    foreach($results as $result){
      if((strtotime($result["time_recorded"]) >= strtotime($this->schoolYear["start"])
        && strtotime($result["time_recorded"]) <= strtotime($this->schoolYear["end"]))
        ){
        $present += 1;
      }
    }
    return $present;

  }

  function numberOfDaysAbsent($studentID){
    $absent = 0;
    $now = date("Y-m-d");
    return $now;
  }

}
?>
