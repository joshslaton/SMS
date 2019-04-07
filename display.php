<?php
include 'DB.inc.php';
$db = new db();
?>

<html>
<head>
  <link href="./style.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/text/javascript"></script>
  <script src="./scripts.js"></script>
</head>
<body>
  <div class="wrapper">
    <div class="sidebar">
      <div class="form-check">
        <div>
          <input type="button" class="btn btn-primary" name="submit" value="Submit" />
        </div>
        <div class="itemTitle">Date</div>
          <?php
          $results = $db->query("select distinct concat(year(time_recorded),'-',month(time_recorded)) as date FROM gatekeeper_in")->fetchAll();
          foreach($results as $result){
            echo "<div><label class='checkbox-wrapper'><input class='form-check-input' type='radio' value='".$result["date"]."' name='date'>".$result["date"]."</label></div>";
          }
          ?>
        <div class="itemTitle">Grade</div>
        <?php
        $results = $db->query("select distinct grade FROM preschool")->fetchAll();
        foreach($results as $result){
          if(!$result["grade"] == "")
            echo "<div><label class='checkbox-wrapper'><input class='form-check-input' type='checkbox' value='".$result["grade"]."' name='grade'>".$result["grade"]."</label></div>";
        }
        ?>
        <div class="itemTitle">Section</div>
        <?php
        $results = $db->query("select distinct section FROM preschool")->fetchAll();
        foreach($results as $result){
          if(!$result["section"] == "")
            echo "<div><label class='checkbox-wrapper'><input class='form-check-input' type='checkbox' value='".$result["section"]."' name='section'>".$result["section"]."</label></div>";
        }
        ?>
      </div>
    </div> <!-- Sidebar Block End-->
    <div class="content-wrapper">
      <div class="content">
        content
      </div>
    </div>
  </div>
</body>
</html>
