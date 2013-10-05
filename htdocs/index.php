<?php
require 'vendor/autoload.php';

date_default_timezone_set('Asia/Manila');

$app = new \Slim\Slim(array('debug' => true));

function connect_to_db() {
    if (isset($_SERVER['ENV']) && $_SERVER['ENV'] == 'PRODUCTION') {
        ORM::configure('mysql:host=' . $_SERVER['DB1_HOST'] . ';dbname=' . $_SERVER['DB1_NAME']);
        ORM::configure('username', $_SERVER['DB1_USER']);
        ORM::configure('password', $_SERVER['DB1_PASS']);
    } else {
        ORM::configure('mysql:host=localhost;dbname=tft_db');
        ORM::configure('username', 'root');
        ORM::configure('password', 'BsqzU4');
    }

    ORM::configure('return_result_sets', true); // returns result sets

    ORM::configure('driver_options', array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8',
    ));
}

$app->get('/', function() use($app) {
    $is_index = true;
    include_once('home.php');
});

$app->get('/ecr', function() use($app) {
    $is_ecr = true;
    include_once('ecr.php');
});

$app->get('/competencies', function() use($app) {
    $is_competencies = true;
    include_once('competencies.php');
});

$app->get('/api/competencies', function() use($app) {

    connect_to_db();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    $grade = $app->request()->get('grade');
    $subject = $app->request()->get('subject');
    if (($grade) && ($subject)) {
        $competencies_status = ORM::for_table('competencies')
            ->raw_query('SELECT grade_level, competencies_json, subject, created_by, created_at FROM competencies WHERE id IN (
                SELECT max(id) FROM competencies GROUP BY concat(grade_level, subject)
                ) AND subject = :subject AND grade_level = :grade',array('subject' => $subject, 'grade' => $grade))->find_array();
        $competencies_status[0]['competencies_json'] = json_decode($competencies_status[0]['competencies_json'],true);
        $competencies_status = $competencies_status[0];
        echo json_encode($competencies_status);
    } elseif (!$grade || !$subject) {
        $subjects_in_grades = array(
            "CLF" => array(0,0,0,0,0,0),
            "Chinese" => array(0,0,0,0,0,0),
            "Filipino" => array(0,0,0,0,0,0),
            "Language" => array(0,0,0,0,0,0),
            "Math" => array(0,0,0,0,0,0),
            "Reading" => array(0,0,0,0,0,0),
            "Science" => array(null,null,0,0,0,0),
            "Social Studies" => array(0,0,0,0,0,0),
            "Music" => array(0,null,null,0,0,0),
            "Arts" => array(null,0,0,0,0,0),
            "PE" => array(0,0,0,0,0,0),
            "HE" => array(null,null,null,0,0,0),
            "Computer" => array(0,0,0,0,0,0)
        );

        foreach ($subjects_in_grades as $subject => $grades) {
            $status['subject'] = $subject;
            $status['status'] = $grades;
            $grade_levels = ORM::for_table('competencies')
                ->raw_query('SELECT grade_level, 1 AS status FROM competencies WHERE id IN (
                    SELECT max(id) FROM competencies GROUP BY subject, grade_level)
                    AND subject = :subject', array('subject' => $subject))
                ->find_array();
            foreach($grade_levels as $grade_level) {
                $status['status'][$grade_level['grade_level'] - 1] = 1;
            }
            $subject_status[] = $status;
        }
        echo json_encode($subject_status);
    }
});

$app->post('/api/competencies', function() use($app) {

    connect_to_db();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';

    $body = json_decode($app->request()->getBody(),true);

    $competency = ORM::for_table('competencies')->create();
    $competency->grade_level = $body['grade_level'];
    $competency->subject = $body['subject'];
    $competency->teachers = '';
    $competency->quarter = 3;
    $competency->competencies_json = json_encode($body['competencies_json']);
    $competency->total_meetings = $body['total_meetings'];
    $competency->max_meetings = $body['max_meetings'];
    $competency->created_by = $body['created_by'];
    $competency->save();

    echo json_encode(array("status" => "success", "id" => $competency->id()));
});

$app->run();