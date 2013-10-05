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
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>-->
    <script src="js/vendor/jquery-2.0.3.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
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
