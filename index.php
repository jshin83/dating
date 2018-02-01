<?php
/*
 * Created by PhpStorm.
 * User: JenShin
 * Date: 1/16/18
 * Time: 11:59 AM
 * index.php, controller, for dating website
 */
session_start();

//require the autoload file
require_once ('vendor/autoload.php');

//create an instance of Base class
$f3 = Base::instance();

$f3->set('DEBUG', 3);

$f3->set('states', array(

    'Alabama',
    'Alaska',
    'Arizona',
    'Arkansas',
    'California',
    'Colorado',
    'Connecticut',
    'Delaware',
    'Florida',
    'Georgia',
    'Hawaii',
    'Idaho',
    'Illinois',
    'Indiana',
    'Iowa',
    'Kansas',
    'Kentucky',
    'Louisiana',
    'Maine',
    'Maryland',
    'Massachusetts',
    'Michigan',
    'Minnesota',
    'Mississippi',
    'Missouri',
    'Montana',
    'Nebraska',
    'Nevada',
    'New Hampshire',
    'New Jersey',
    'New Mexico',
    'New York',
    'North Carolina',
    'North Dakota',
    'Ohio',
    'Oklahoma',
    'Oregon',
    'Pennsylvania',
    'Rhode Island',
    'South Carolina',
    'South Dakota',
    'Tennessee',
    'Texas',
    'Utah',
    'Vermont',
    'Virginia',
    'Washington',
    'West Virginia',
    'Wisconsin',
    'Wyoming' ));

$f3->set('indoor', array(
    'tv',
    'movies',
    'cooking',
    'board games',
    'puzzles',
    'reading',
    'playing cards',
    'video games'
));
$f3->set('outdoor', array(
   'hiking',
   'biking',
   'swimming',
   'collecting',
   'walking',
   'climbing'
));

//include ('model/validate.php');


//set default path to page/home
$f3->route('GET /', function() {
    $view = new Template();
    echo $view -> render('pages/home.html');
});

//personal info page
$f3->route('GET|POST /personal', function($f3) {
    //print_r($_POST);


    if (isset ($_POST['submit'])) {
        $first = ucfirst(strtolower($_POST['first']));
        $last = ucfirst(strtolower($_POST['last']));
        $name = $first.' '.$last;
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $errors = $_POST['errors'];

       // echo "name $name, age $age, gender $gender, phone $phone, ";

        include ('model/validate.php');


        $_SESSION['name'] = $name;
        $_SESSION['age'] = $age;
        $_SESSION['gender'] = $gender;
        $_SESSION['phone'] = $phone;
        $success = $_POST['success'];

        //$errors = validatePersonalInfo($name, $age, $phone, $gender);

        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        $f3->set('errors', $errors);
        $f3->set('success', $success);

        if($success) {
            //redirect
            $f3->route('GET /profile');
        }
//        } else {
////            echo the template
//            $view = new Template();
//            echo $view -> render('pages/personal_info.html');
//        }
    }
 //   print_r($_SESSION);
 //   print_r( $errors);
    $view = new Template();
    echo $view -> render('pages/personal_info.html');
});

//profile page
$f3->route('GET|POST /profile', function($f3) {
    /*$f3->set('first', $_POST['first']);
    $f3->set('last', $_POST['last']);
    $f3->set('age', $_POST['age']);
    $f3->set('gender', $_POST['gender']);
    $f3->set('phone', $_POST['phone']);
*/


    $view = new Template();
    echo $view -> render('pages/profile.html');
});

//interests
$f3->route('GET|POST /interests', function() {
    //echo '<h1>Form 1</h1>'; //testing purposes

    $view = new Template();
    echo $view -> render('pages/interests.html');
});

//results
$f3->route('GET|POST /results', function() {
    $view = new Template();
    echo $view -> render('pages/results.html');
});

//run fat free
$f3->run();