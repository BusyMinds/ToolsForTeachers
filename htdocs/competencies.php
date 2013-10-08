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
    <!--<script src="js/vendor/underscore.min.js"></script>-->
    <script src="js/vendor/angular.min.js?minify=true"></script>
    <script src="js/competencies/globals.js?minify=true"></script>
    <script src="js/competencies/app.js?minify=true"></script>
    <!-- // <script src="js/competencies/services.js"></script> -->
    <script src="js/competencies/controllers.js?minify=true"></script>
    <script src="js/vendor/ui-bootstrap-custom-0.6.0.min.js"></script>
    <script src="js/vendor/ui-bootstrap-custom-tpls-0.6.0.min.js"></script>
    <!-- // <script src="js/vendor/ui-select2.js"></script> -->
    <!-- // <script src="js/competencies/filters.js"></script> -->
    <!-- // <script src="js/competencies/directives.js"></script> -->

    <?php include_once("analyticstracking.php"); ?>
  </body>
</html>
