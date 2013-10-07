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
                if (int == 0) {
                    return "Incomplete";
                } else if (int > 0) {
                    return "Complete";
                } else {
                    return "--";
                }
            };

            $scope.status_int_to_class = function (int) {
                if (int == 0) {
                    return "danger text-danger";
                } else if (int > 0) {
                    return "success text-success";
                } else {
                    return "";
                }
            };

            $scope.status_int_to_glyphicon = function (int) {
                if (int == 0) {
                    return "glyphicon glyphicon-thumbs-down";
                } else if (int > 0) {
                    return "glyphicon glyphicon-thumbs-up";
                } else {
                    return "";
                }
            };
        });


    }])
    .controller('EditController', ['$scope','$http','$routeParams',function($scope,$http,$routeParams) {
        $scope.competencies = [{"competency": null, "duration": 1}];
        // $scope.created_by = "";
        if ($routeParams.grade != null && $routeParams.subject != null) {
            // console.log($routeParams);
            $scope.grade = parseInt($routeParams.grade);
            $scope.subject = $routeParams.subject;

            $http.get('/api/competencies?grade=' + $routeParams.grade + '&subject=' + $routeParams.subject).success(function(data){
                console.log(data);
                $scope.competencies = data.competencies_json;
                $scope.created_by = data.created_by;
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

        var trim_competencies = function () {
            if (($scope.competencies.length > 1) && ($scope.competencies[$scope.competencies.length - 1].competency == null)) {
                $scope.competencies.splice($scope.competencies.length - 1,1);
            }
            return $scope.competencies.length;
        }

        $scope.post_data = {};

        $scope.teachers = ["Melanie Abello","Michael David John Abello","Alex Carl Almeda","Avenger Alob Jr.",
            "Marley Arbon","Mary Immaculate Aringay","John Symon Bailon","Mylene Bersabal","Vanessa Caballero",
            "Rachel Cabuco","Rizza Jane Cañete","Priscilliano Capangpangan","Charlito Codizar","Fidelis Cuay",
            "Mylene Louise Curso","Jasmin Del Mar","Glen Delator","April Dawn Dizon","Christine Duran",
            "Reydon Encinares","Virginia Escosora","Ma. Filipina Evano","Mitos Gonzales","Ma. Antonia Huan",
            "Krizmagnum Ibaos","Alven Rey Labadan","Pamela Labadan","Regine Lagrimas","Rosie Fe Legaspino",
            "Estelita Lim","Sheng Liu","Noel Martin Llevares","Marybeth Macarayan","Ma. Rubelyn Macion",
            "Prety Maloloy-on","Jennifer Manatad","Marvi Maquilan","Mary Lourdes Melloria","Marisse Paraoan",
            "Racel Parilla","Clark Ian Pelen","Ma. Elizabeth Pelen","Avecenna Peteros","Rohaiba Radiamoda",
            "Maria Christine Ramirez","Bernice Marsha Reyes","Mildred Rios","Mary Jane Rodrigo",
            "Jacqueline Therese Sanchez","Concepcion Agnes Sarza","May Sastre","Estela Serrano",
            "Anthony Hejie Suralta","Nilda Torregosa","Maria Lisandra Tugaoen","Nancy Uy","Eve Vecina",
            "Jean Eleonor Velasco","Mae Divina Velasco","Bei Yao","Cecilia Yap","Grace Yap","Susana Yap",
            "Paul John Ylanan","Xiaoyan Zhang","Annie Abucay","Lea Amores"];

        $scope.are_entries_valid = function () {
            var items_to_validate = [$scope.grade,$scope.subject,$scope.created_by];
            var are_competencies_valid, are_inputs_valid
            if (($scope.competencies.length > 0) && ($scope.competencies[0].competency != null)) {
                are_competencies_valid = true;
            } else {
                are_competencies_valid = false;
            }
            are_inputs_valid = true;
            angular.forEach(items_to_validate,function(value){
                if (value == null || value == undefined) {
                    are_inputs_valid = false;
                }
            });
            return (are_competencies_valid && are_inputs_valid);
        };

        $scope.save_these_competencies = function () {
            if ((trim_competencies() > 0) && ($scope.are_entries_valid())) {
                $scope.post_data = {
                    "grade_level": $scope.grade,
                    "subject": $scope.subject,
                    "total_meetings": $scope.get_total_meetings(),
                    "max_meetings": $scope.get_max_meetings(),
                    "competencies_json": $scope.competencies,
                    "created_by": $scope.created_by
                };
                console.log($scope.post_data);
                $http.post('/api/competencies', $scope.post_data).success(function(data){
                    alert("Thank you. Your changes has been saved. You will now be redirected back to the status page.");
                    window.location = "#/list";
                }).error(function(data){
                    console.log(data);
                });
            } else {
                // alert('Entries are invalid.');
                console.log('Entries are invalid.');
            }
        };
    }]);