<?php
include_once("../../includes/DB.inc.php");
$db = new db();

if(isset($_POST["studentID"]) && $_POST["studentID"] != ""){
    $studentID = $_POST["studentID"];
    echo "<table class='table'>";
    if($results = $db->query("SELECT * FROM preschool WHERE idnumber LIKE '%".$studentID."%'")->fetchAll()){
      foreach($results as $result){
        echo "<tr id='studentInfo' data-id='".$result["idnumber"]."' data-name='".$result["name"]."'>";
        echo "<td>".$result["idnumber"]."</td>";
        echo "<td>".$result["name"]."</td>";
        echo "<td>".$result["grade"]." - ".$result["section"]."</td>";
        echo "</tr>";
      }
    }
    echo "</table>";
}
?>
