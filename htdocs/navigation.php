<?php
switch (basename($_SERVER['PHP_SELF'], '.php')) {
  case "index":
    $is_index = true;
    break;
  case "ecr":
    $is_ecr = true;
    break;
  case "competencies":
    $is_competencies = true;
    break;
  default:
    $is_index = true;
    break;
}
?>
<div class="header">
  <ul class="nav nav-pills pull-right">

    <?php
    echo ((isset($is_index)) ? "<li class=\"active\">" : "<li>")
    ?>
    <a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>

    <?php
    echo ((isset($is_ecr)) ? "<li class=\"active\">" : "<li>")
    ?>
    <a href="ecr.php"><span class="glyphicon glyphicon-th-list"></span> ECR</a></li>

    <?php
    echo ((isset($is_competencies)) ? "<li class=\"active\">" : "<li>")
    ?>
    <a href="competencies.php"><span class="glyphicon glyphicon-tasks"></span> Competencies</a></li>

  </ul>
  <h3 class="text-primary"><strong><span class="glyphicon glyphicon-th"></span> SHS-AdC Tools for Teachers</strong></h3>
</div>