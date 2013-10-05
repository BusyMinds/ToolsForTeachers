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
    <?php include_once("jquery-bootstrap-js.php"); ?>
    <!--<script src="js/vendor/underscore.min.js"></script>-->
    <script src="js/vendor/angular.min.js"></script>
    <script src="js/competencies/app.js"></script>
    <!-- // <script src="js/competencies/services.js"></script> -->
    <script src="js/competencies/controllers.js"></script>
    <!-- // <script src="js/competencies/filters.js"></script> -->
    <!-- // <script src="js/competencies/directives.js"></script> -->

    <?php include_once("analyticstracking.php"); ?>
  </body>
</html>
