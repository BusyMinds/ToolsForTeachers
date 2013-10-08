<!DOCTYPE html>
<html class="no-js">
  <?php include_once("head.php"); ?>
  <body ng-app="myApp">
    <div class="container">
      <?php include_once("navigation.php"); ?>

      <div ng-view></div>

      <?php include_once("disqus.php"); ?>
      <?php include_once("footer.php"); ?>

    </div>
    <?php include_once("common-includes.js.php"); ?>
    <script src="js/vendor/angular.min.js"></script>
    <?php
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
    ?>
    <script src="js/competencies/globals.js"></script>
    <script src="js/competencies/app.js"></script>
    <script src="js/competencies/controllers.js"></script>
    <?php
    } else {
    ?>
    <script src="js/competencies/globals.js?packer=true"></script>
    <script src="js/competencies/app.js?packer=true"></script>
    <script src="js/competencies/controllers.js?packer=true"></script>
    <?php
    }
    ?>
    <script src="js/vendor/ui-bootstrap-custom-0.6.0.min.js"></script>
    <script src="js/vendor/ui-bootstrap-custom-tpls-0.6.0.min.js"></script>

    <?php include_once("analyticstracking.php"); ?>
  </body>
</html>
