<?php
include "student.php";
$db = new db();
$student = new Student();
if(isset($_POST['gradeLevel']) && $_POST['gradeLevel'] != ""){
  $gradeLevel = $_POST['gradeLevel'];
  foreach($gradeLevel as $gl){
    foreach($student->getSection($gl) as $section){
      echo "<div class='form-check'>";
      echo "<input class='form-check-input' name='section' type='checkbox' value='".$section."' id='section-".$section."'>";
      echo "<label class='form-check-label' for='section-".$section."'>";
      echo $gl." - ".$section;
      echo "</label>";
      echo "</div>";
    }
  }
}
?>
