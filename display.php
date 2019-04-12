<?php
include "student.php";
$student = new Student();

// print_r($student->getSection("kinder"));
?>

<html>
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/text/javascript"></script>
    <script src="./scripts.js"></script>
    <link href="./style.css" rel="stylesheet">
  </head>
  <body>
    <div class='wrapper'>
      <div class='options-container'>

        <?php
        // Date
        echo "<div class='tab'>";
        echo "<div class='tabTitle red'>Date</div>";
        $c = 1;
        foreach($student->getDates() as $dates){
          echo "<div class='form-check'>";
          echo "<input class='form-check-input' name='date' type='radio' value='".$dates["date"]."' id='section".$c."'>";
          echo "<label class='form-check-label' for='section".$c."'>";
          echo $dates["date"];
          echo "</label>";
          echo "</div>";
          $c = $c + 1;
        }
        echo "</div>";

        // Grade Level
        echo "<div class='tab'>";
        echo "<div class='tabTitle orange'>Grade Level</div>";
        foreach($student->getGradeLevel() as $gradeLevel){
          echo "<div class='form-check'>";
          echo "<input class='form-check-input' name='grade' type='radio' value='".$gradeLevel."' id='gradelevel-".$gradeLevel."'>";
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
        echo "<div class='tabTitle yellow'>Section</div>";
        foreach($student->getSection() as $section){
          echo "<div class='form-check'>";
          echo "<input class='form-check-input section' name='section' type='radio' value='".$section."' id='section-".$section."'>";
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
        echo "<div class='tabTitle green'>Gender</div>";
        foreach($student->getGender() as $gender){
          foreach($gender as $g){
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' name='gender' type='checkbox' value='".$g."' id='gender-".$g."'>";
            echo "<label class='form-check-label' for='gender-".$g."'>";
            echo $g;
            echo "</label>";
            echo "</div>";
          }
        }
        echo "</div>";

        ?>
      </div>
      <div class="content" name="content">
        <?php
          // echo "<pre>";
          // print_r($student->getSection2());
          // echo "<pre>";
        ?>
      </div>
  </div>
  </body>
</html>
<!-- Grade | Section | Gender -->
