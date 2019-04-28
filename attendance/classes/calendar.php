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
    $this->monthsToIterate = $this->monthsToIterate($this->schoolYear["start"], $this->schoolYear["end"]);
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

  // TODO: Remove this soon
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

  // Which days are school days based on schedule
  function numberOfSchoolDays($startDate, $endDate, $subjectCode){
    $db = new db("localhost", "kiosk", "kiosk", "school");
    $q = "SELECT * FROM subjects WHERE code='$subjectCode'";
    $results = $db->query($q)->fetchAll();
    print_r($results[0]["days"]);
    $schoolDaysarray = Array();
    $begin = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = DateInterval::createFromDateString("1 day");
    $period = new DatePeriod($begin, $interval, $end);
    foreach($period as $p){
      // echo $p->format("Y-m-d");
      // echo "<br>";
    }

    return "";
  }


  // TODO: efficient way to check attendance.
  function numberOfDaysPresent($studentID){
    $present = 0;
    $absent = 0;
    $results = $this->db->query("SELECT DISTINCT concat(year(`time_recorded`),'-',month(`time_recorded`),'-',day(`time_recorded`)) as date FROM gatekeeper_in WHERE idnumber='".$studentID."'")->fetchAll();

    $begin = new DateTime($this->schoolYear["start"]);
    $end = new DateTime($this->schoolYear["end"]);

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);

    foreach ($period as $dt) {
      echo $dt->format("Y-m-d");
      echo "<br>";
    }
    return $present;

  }

  function numberOfDaysAbsent($studentID){
    $absent = 0;
    $now = date("Y-m-d");
    return $now;
  }

}

$c = new calendar();
$c->numberOfSchoolDays("2018-08-13", "2019-05-31", "GEN");
// $c->numberOfDaysPresent("2900876");

$start = new DateTime("2018-08-13");
$end = new DateTime("2019-05-31");
// print_r($start->format("Y-m-d"));
?>
