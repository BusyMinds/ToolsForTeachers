'use strict';

/* Controllers */

angular.module('myApp.controllers', []).
    controller('ListController', ['$scope','$http',function($scope,$http) {

        $http.get('api/competencies').success(function(data){
            $scope.subject_status = data;

            var overall_status = function () {
                var sum = 0;
                var total_competencies = 70;
                var percentage;
                for (var i = 0; i < $scope.subject_status.length; i++) {
                    for (var j = 0; j < $scope.subject_status[i].status.length; j++) {
                        if ($scope.subject_status[i].status[j]) {
                            sum += $scope.subject_status[i].status[j];
                        }
                    }
                }
                percentage = sum * 100 / total_competencies;

                return {
                    "percentage": percentage.toPrecision(2).toString() + '%',
                    "detail": '(' + sum.toString() + ' out of ' + total_competencies.toString() + ')',
                };
            };

            $scope.overall_status_percentage = overall_status().percentage;
            $scope.overall_status_detail = overall_status().detail;

            $scope.status_int_to_string = function (int) {
                switch (int) {
                    case null:
                        return "";
                    case 0:
                        return "Incomplete";
                    case 1:
                        return "Complete";
                }
            };

            $scope.status_int_to_class = function (int) {
                switch (int) {
                    case null:
                        return "";
                    case 0:
                        return "danger text-danger";
                    case 1:
                        return "success text-success";
                }
            };

            $scope.status_int_to_glyphicon = function (int) {
                switch (int) {
                    case null:
                        return null;
                    case 0:
                        return "glyphicon glyphicon-thumbs-down";
                    case 1:
                        return "glyphicon glyphicon-thumbs-up";
                }
            };
        });


    }])
    .controller('EditController', ['$scope','$http','$routeParams',function($scope,$http,$routeParams) {

        $scope.competencies = [{"competency": null, "duration": 1}];

        if ($routeParams != {}) {
            $scope.grade = parseInt($routeParams.grade);
            $scope.subject = $routeParams.subject;

            $http.get('/api/competencies?grade=' + $routeParams.grade + '&subject=' + $routeParams.subject).success(function(data){
                console.log(data);
                $scope.competencies = data.competencies_json;
            });
        }

        // $scope.routeParams = $routeParams;
        $scope.subject_choices = function(grade) {
            var subjects_in_grades = [
                ["CLF", "Chinese", "Filipino", "Language", "Math","Reading",            "Social Studies","Music",         "PE",       "Computer"],
                ["CLF", "Chinese", "Filipino", "Language", "Math","Reading",            "Social Studies",         "Arts", "PE",       "Computer"],
                ["CLF", "Chinese", "Filipino", "Language", "Math","Reading", "Science", "Social Studies",         "Arts", "PE",       "Computer"],
                ["CLF", "Chinese", "Filipino", "Language", "Math","Reading", "Science", "Social Studies","Music", "Arts", "PE", "HE", "Computer"],
                ["CLF", "Chinese", "Filipino", "Language", "Math","Reading", "Science", "Social Studies","Music", "Arts", "PE", "HE", "Computer"],
                ["CLF", "Chinese", "Filipino", "Language", "Math","Reading", "Science", "Social Studies","Music", "Arts", "PE", "HE", "Computer"]
            ];
            return subjects_in_grades[grade - 1];
        };


        $scope.get_max_meetings = function () {
            if ($scope.subject == null || $scope.grade == null) {
                return null;
            } else {
                var schedule = {
                    "CLF": [3,3,3,3,3,3],
                    "Chinese": [4,4,4,4,4,4],
                    "Filipino": [3,3,3,5,5,5],
                    "Language": [4,4,4,3,3,3],
                    "Math": [5,5,5,5,5,5],
                    "Reading": [4,4,4,4,4,4],
                    "Science": [0,0,5,5,5,5],
                    "Social Studies": [4,4,4,4,4,4],
                    "Music": [1,0,0,1,1,1],
                    "Arts": [0,1,1,1,1,1],
                    "PE": [1,1,1,1,1,1],
                    "HE": [0,0,0,1,1,1],
                    "Computer": [1,1,1,1,1,1]
                };
                return schedule[$scope.subject][$scope.grade - 1] * 5;
            }
        };

        $scope.get_total_meetings = function () {
            var total = 0;
            for (var i = 0; i < $scope.competencies.length; i++) {
                total += $scope.competencies[i].duration;
            }
            return total;
        };

        $scope.get_remaining_meetings = function (duration) {
            var meetings_left = $scope.get_max_meetings() - $scope.get_total_meetings() + duration;
            return (meetings_left > 1) ? meetings_left : 1;
        };

        $scope.add_new_competency = function () {
            if ($scope.competencies.length < $scope.get_max_meetings()) {
                if ($scope.competencies[$scope.competencies.length - 1].competency != null) {
                    $scope.competencies.push({"competency": null, "duration": 1});
                }
            }
        };

        $scope.delete_this_competency = function (index) {
            if ($scope.competencies.length > 1) {
                $scope.competencies.splice(index,1);
            } else {
                $scope.competencies[index] = {"competency": null, "duration": 1};
            }
        };

        $scope.post_data = {};
        $scope.save_these_competencies = function () {
            if ($scope.competencies[$scope.competencies.length - 1].competency == null) {
                $scope.competencies.splice($scope.competencies.length - 1,1);
            }
            $scope.post_data = {
                "grade_level": $scope.grade,
                "subject": $scope.subject,
                "total_meetings": $scope.get_total_meetings(),
                "max_meetings": $scope.get_max_meetings(),
                "competencies_json": $scope.competencies,
                "created_by": "Noel"
            };
            // console
            $http.post('/api/competencies', $scope.post_data).success(function(data){
                alert("Thank you. Your data has been saved.");
                window.location = "#/list";
            }).error(function(data){
                console.log(data);
            });
        };
    }]);