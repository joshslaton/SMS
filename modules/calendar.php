<?php
class Calendar{
  // TODO: color coded day that have passed and have not.

  function buildCalendar($month, $year){
    $monthName =
    $calendar = "<table class='calendar'>";
    $calendar .= "<caption>Caption</caption>";
  }

  function daysInMonth($m){
    return date("t", strtotime($m));
  }

  function isWeekend($date){
    // which are saturdays and sundays on $month

    $mon = date("m",strtotime($date));
    $day = date("d",strtotime($date));
    $year = date("Y",strtotime($date));
    $dow  = date("N", strtotime($date));

    // h, m, s, M, d, Y
    if($dow == 6 || $dow == 7){
      return True;
    }
    return False;
  }

  // TODO: Should hard code this in the database?
  function isHoliday($date){
    $holidays = Array(
      "January" => Array(1 => "New Year"),
      "February" => Array(5 => "Chinese New Year", 25 => "EDSA Revolution"),
      "April" => Array(18 => "Maundy Thursday", 19 => "Good Friday", 20 => "Black Saturday"),
      "May" => Array(1 => "Labor Day"),
      "June" => Array(12 => "Independence Day"),
      "August" => Array(21 => "Ninoy Aquino Day", 26 => "National Heroes Day"),
      "November" => Array(1 => "All Saints Day", 2 => "All Souls Day", 30 => "Bonifacio Day"),
      "December" => Array(8 => "Feast of Immaculate Conception", 25 => "Christmas Day", 31 => "Last Day of the Year"));

    foreach($holidays as $month=>$days){
      if(date("F", strtotime($date)) == $month){
        foreach($days as $day=>$name_of_holiday){
          if($day == date("d", strtotime($date)))
            return True;
        }
        return False;
      }
    }
  }

} // End of Calendar Class

// $cal = new Calendar();
// echo "<pre>";
// print_r($cal -> isHoliday("2019-04-05"));
// print_r($cal -> isHoliday("2019-04-05"));
// echo "</pre>";
?>
