<?php
include "DB.inc.php";

$db = new db();
if($results = $db->query("SELECT DISTINCT month(time_recorded) FROM gatekeeper_in")->fetchAll()){
  var_dump($results);
}
?>
