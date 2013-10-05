<div class="row">
  <p><a class="btn" href="#/list"><span class="glyphicon glyphicon-backward"></span> Back to status page</a></p>
</div>
<div class="row" ng-cloak>
  <div class="col-md-4 col-md-push-8">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Instructions</h3>
      </div>
      <div class="panel-body">
        <ol>
          <li>Choose a grade level.</li>
          <li>Choose a subject.</li>
          <li>The number of estimated allowed meetings will be shown to you. Plan your number of meetings according to that estimate.</li>
          <li>Enter one competency in each line and its corresponding number of meetings.</li>
          <li>To add another competency, click on the <code>Add</code> button or press the <code>Enter</code> key.</li>
          <li>To delete a competency, click on its corresponding <code>Trash</code> (<span class="glyphicon glyphicon-trash"></span>) button.</li>
          <li>Click <code>Save</code> when you're ready to save it.</li>
          <li>If it is saved successfully, a message box will appear telling you that it was saved successfully.</li>
          <li>Finally, you'll be redirected back to the status page where you should see the status of your subject and grade level updated.</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-md-pull-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Competencies</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label for="inputGrade" class="col-xs-2 control-label">Grade:</label>
            <div class="col-xs-10">
              <select id="inputGrade" class="form-control" ng-model="grade" ng-options="n for n in [1,2,3,4,5,6]" required>
                <option value="">Choose a grade level</option>
              </select>
            </div>
          </div>
          <div class="form-group" ng-show="grade">
            <label for="inputSubject" class="col-xs-2 control-label">Subject:</label>
            <div class="col-xs-10">
              <select id="inputSubject" class="form-control" ng-model="subject" ng-options="choice for choice in subject_choices(grade)" required>
                <option value="">Choose a subject</option>
              </select>
            </div>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-info" ng-show="get_max_meetings(subject,grade)">Please plan for <strong>{{get_max_meetings(subject,grade)}} meetings</strong> in the 3rd Quarter.
              Arrange them in chronological order.</div>
          </div>
        </div>
        <form role="form" ng-show="get_max_meetings(subject,grade)">
          <table class="table table-responsive">
          <thead>
            <th class="col-xs-9">Competencies</th>
            <th class="col-xs-2">Meeting(s)</th>
            <th class="col-xs-1">Delete?</th>
          </thead>
          <tbody>
            <tr ng-repeat="item in competencies">
              <td>
                <label class="sr-only" for="inputCompetency{{$index}}">{{item.competency}}</label>
                <input type="text" class="form-control" id="inputCompetency{{$index}}" placeholder="Competency" ng-model="item.competency" required>
              </td>
              <td>
                <label class="sr-only" for="inputDuration{{$index}}">Duration</label>
                <input type="number" min="1" max="{{get_remaining_meetings(subject,grade,item.duration)}}" class="form-control" id="inputDuration{{$index}}" value="1" ng-model="item.duration" required>
              </td>
              <td>
                <button type="button" class="btn btn-default" ng-click="delete_this_competency($index)">
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <button class="btn btn-default" ng-click="add_new_competency()">Add</button>
              </td>
              <td colspan="2">
                <span class="text-info">
                  <ng-pluralize count="get_total_meetings()" when="{'one': '1 meeting','other': '{} meetings'}"></ng-pluralize>
                </span>
              </td>
            </tr>
          </tbody>
          </table>
          <button type="submit" class="btn btn-primary" ng-click="save_these_competencies()">Save</button>
          <!-- <button type="submit" class="btn btn-primary" data-toggle="modal" href="#saveModal">Save</button> -->
        </form>
      </div>
    </div>
  </div>
</div>
<pre>{{post_data | json}}</pre>