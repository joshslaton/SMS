<?php
// https://stackoverflow.com/questions/14080049/jquery-changing-value-binding-in-database-with-ajax-mysql
include "./student.php";

$student = new Student();
$student -> init();

if(isset($_POST["date"]) && isset($_POST["grade"]) && isset($_POST["sec"]) && isset($_POST["gender"])){
  $m = date("n", strtotime($_POST["date"]."-1"));
  $grade = $_POST["grade"];
  $section = $_POST["sec"];
  $gender = $_POST["gender"];

  // Lazy coding: Cheat to add mysql condition where male and female is included.
  $stmt = (sizeof($gender) > 1 ? "'m' & 'f'" : ($gender[0]=='m' ? "'m'" : "'f'"));

  $dom = date("t", mktime(0, 0, 0, $m, 1));
?>

<table class="table">
    <!--  PUT THIS IN A FUNCTION -->
    <tr class="tableHead">
      <?php
      echo "<td>".date("F", mktime(0, 0, 0, $m, 1))."</td>";
        for($i = 1; $i <= $dom; $i++){
          echo "<td class='tDay'>".$i."</td>";
        }
      ?>
      <td></td>
    </tr>
    <tr class="tableHead">
      <td></td>
      <?php
        for($i = 1; $i <= $dom; $i++){
          echo "<td class='tDay'>".date("D", mktime(0, 0, 0, $m, $i))."</td>";
        }
      ?>
      <td></td>
    </tr>
    <!-- <tr>
      <td>Student</td>
    </tr> -->
      <?php
      $db = new db();
      // TODO: Sort male and female
      $q = "SELECT idnumber, name, grade FROM preschool WHERE grade='".$grade."' and section='".$section."' and gender=".$stmt;
      print_r($q);
      if($results = $db->query($q)->fetchAll()){
        foreach($results as $result){
          if(!$result["grade"] == ""){
            echo "<tr>";
            echo "<td class='tdStudent'>".$result["idnumber"]."<br>".$result["name"]."</td>";
            // Check each day of month if student has time record in it
            for($i=1; $i<=$dom; $i++){
              print($student->studentHasRecord($result["idnumber"],"2019-".$m."-".$i));
            }
          }
        }
      }
      ?>
      <tr>
  </thead>
</table>

<?php
}
?>
