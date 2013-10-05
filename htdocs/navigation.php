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
<!-- <div class="header">
  <ul class="nav nav-pills pull-right">

    <?php
    // echo ((isset($is_index)) ? "<li class=\"active\">" : "<li>")
    ?>
    <a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>

    <?php
    // echo ((isset($is_ecr)) ? "<li class=\"active\">" : "<li>")
    ?>
    <a href="ecr.php"><span class="glyphicon glyphicon-th-list"></span> ECR</a></li>

    <?php
    // echo ((isset($is_competencies)) ? "<li class=\"active\">" : "<li>")
    ?>
    <a href="competencies.php"><span class="glyphicon glyphicon-tasks"></span> Competencies</a></li>

  </ul>
  <h3 class="text-primary"><strong><span class="glyphicon glyphicon-th"></span> SHS-AdC Tools for Teachers</strong></h3>
</div> -->

<!-- Fixed navbar -->
<div class="navbar navbar-blue navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">SHS-AdC Tools for Teachers</a>
    </div>
    <div class="navbar-collapse collapse">
      <!-- <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
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
    </div><!--/.nav-collapse -->
  </div>
</div>