<!DOCTYPE html>
<html class="no-js">
  <?php include_once("head.php"); ?>
  <body>
    <div class="container">
      <?php include_once("navigation.php"); ?>

      <div class="jumbotron">
        <h1><strong class="text-primary">Electronic Class Record</strong></h1>
        <p class="lead">
          Latest version: <strong class="text-info">930</strong><br>
          Last updated: <strong class="text-info">September 30, 2013</strong><br>
        </p>
        <ul class="list-inline">
          <li><a class="btn btn-primary btn-lg" href="#downloads"><span class="glyphicon glyphicon-download-alt"></span> Go to downloads</a></li>
          <li><a class="btn btn-default btn-lg" href="#disqus_thread"><span class="glyphicon glyphicon-warning-sign"></span> Submit an issue</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary" id="downloads">
            <div class="panel-heading">
              <h3 class="panel-title">Downloads</h3>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled">
                <li><em>To download all your templates, click each file that belongs to you.</em></li>
                  <ul>
                    <?php
                      foreach (glob('/files/*.xlsm') as $filepath) {
                        $filename = str_replace("/files/", "", $filepath);
                        echo "<li><a href=\"download.php?file=$filename\">" . $filename . "</a></li>\n";
                      }
                    ?>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Latest Changes</h3>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled">
                <li><em>Version 930: (September 30, 2012)</em></li>
                <li>
                  <ul>
                    <li>Corrected conduct transmutation to letter grades.</li>
                    <li class="text-muted">Improved configuration procedure on first start</li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <a href="#changelog">Click to see the changes in previous versions.</a>
            </div>
          </div>
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Known Issues</h3>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled">
                <li><em>Version 930: (September 30, 2013)</em></li>
                <li>
                  <ul>
                    <!-- <li class="text-muted">No known issues yet.</li> -->
                    <li>No ECR templates available yet for:
                      <ul>
                        <li>GEM classes</li>
                        <li>Special Chinese classes</li>
                        <li>Special Filipino classes</li>
                        <li>Applied Music classes</li>
                      </ul>
                    </li>
                    <li>ECR uploader app not yet available.</li>
                    <li class="text-muted">Configuration procedure still needs speed improvements.</li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <a href="#disqus_thread">Post a comment below to submit an issue.</a>
            </div>
          </div>
          <div class="panel panel-default" id="changelog">
            <div class="panel-heading">
              <h3 class="panel-title">Previous Changes</h3>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled">
                <li><em>Version 920: (September 20, 2013)</em></li>
                <li>
                  <ul>
                    <li>First proper supported release that can be used from 2nd Quarter onwards.</li>
                    <li class="text-muted">Important data can now be accessed in JSON format.</li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <?php include_once("disqus.php"); ?>
      <div class="footer">
        <p>&copy; SHS-AdC ICT Team</p>
      </div>

    </div>
    <?php include_once("jquery-bootstrap-js.php"); ?>
    <?php include_once("analyticstracking.php"); ?>
  </body>
</html>
