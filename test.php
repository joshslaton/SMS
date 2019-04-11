<?php
include "DB.inc.php";

  Class student{
    function __construct(){
      $this->db = new db();
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
      if($results = $db->query($q)->fetchAll()){
        foreach($results as $result){
          array_push($dates, $result);
        }
      }
      return $dates;
    }

} // End of Class

$student = new Student();
// echo "<pre>";
print_r($student->getGender());
echo "<pre>";
print_r($student->getSection("kinder"));
?>

<html>
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/text/javascript"></script>
    <script src="./test.js"></script>
    <link href="./test.css" rel="stylesheet">
  </head>
  <body>
    <div class='wrapper'>
      <div class='options-container'>

        <?php
        // Date
        echo "<div class='tab'>";
        echo "<div class='tabTitle'>Date</div>";
        echo "</div>";

        // Grade Level
        echo "<div class='tab'>";
        echo "<div class='tabTitle'>Grade Level</div>";
        foreach($student->getGradeLevel() as $gradeLevel){
          echo "<div class='form-check'>";
          echo "<input class='form-check-input' type='checkbox' value='".$gradeLevel."' id='gradelevel-".$gradeLevel."'>";
          echo "<label class='form-check-label' for='gradelevel-".$gradeLevel."'>";
          echo $gradeLevel;
          echo "</label>";
          echo "</div>";
        }
        echo "</div>";
        ?>

        <?php
        // Section
        echo "<div class='tab'>";
        echo "<div class='tabTitle'>Section</div>";
        foreach($student->getSection("kinder") as $section){
          echo "<div class='form-check'>";
          echo "<input class='form-check-input' type='checkbox' value='".$section."' id='section-".$section."'>";
          echo "<label class='form-check-label' for='section-".$section."'>";
          echo $section;
          echo "</label>";
          echo "</div>";
        }
        echo "</div>";
        ?>

        <?php
        // Grade Level
        echo "<div class='tab'>";
        echo "<div class='tabTitle'>Gender</div>";
        foreach($student->getGender() as $gender){
          foreach($gender as $g){
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='checkbox' value='".$g."' id='gender-".$g."'>";
            echo "<label class='form-check-label' for='gender-".$g."'>";
            echo $g;
            echo "</label>";
            echo "</div>";
          }
        }
        echo "</div>";
        ?>
      </div>
  </div>
  </body>
</html>
<!-- Grade | Section | Gender -->
