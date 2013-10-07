<!DOCTYPE html>
<html class="no-js">
  <?php include_once("head.php"); ?>
  <body>
    <div class="container">
      <?php include_once("navigation.php"); ?>

      <div class="jumbotron">
        <h1>Welcome to <strong class="text-primary">SHS-AdC Tools for Teachers</strong></h1>
        <p class="lead">
          This is an ad-hoc website made for the purpose of having a standard go-to website for all things developed by the ICT team for the teachers.
        </p>
        <p class="lead">
          All projects are found below.
        </p>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Electronic Class Records</h3>
            </div>
            <div class="panel-body">
              <p>Download your ECR templates by going to the ECR download page.</p>
              <a class="btn btn-default" href="/ecr"><span class="glyphicon glyphicon-th-list"></span></span> Go to ECR page</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Competency Planner</h3>
            </div>
            <div class="panel-body">
              <p>Submit your list of competencies for the next Quarter.</p>
              <a class="btn btn-default" href="/competencies"><span class="glyphicon glyphicon-check"></span> Go to Competency Planner</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Trends</h3>
            </div>
            <div class="panel-body">
              <p class="text-muted">
                <strong><em>Coming soon!</em></strong> <br>
                Investigate different trends and various statistics related to our pupil's grades and exam results.</p>
              <a class="btn btn-default" href="#" disabled><span class="glyphicon glyphicon-stats"></span> View Trends</a>
            </div>
          </div>
        </div>
      </div>

      <?php include_once("footer.php"); ?>

    </div>
    <?php include_once("jquery-bootstrap-js.php"); ?>
    <?php include_once("analyticstracking.php"); ?>
  </body>
</html>
