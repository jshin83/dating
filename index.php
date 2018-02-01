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
//include ('model/validate.php');


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
        if(!validPhone($phone))
        {
            $errors['phone'] = "Please enter a 10 digit phone number with dashes.";
        }

        if(!validAge($age))
        {
            $errors['age'] = "Please enter all numbers - must be 19 or older.";
        }

        if(!validString($first))
        {
            $errors['name'] = "Required: name must be all letters.";
        }

        if(!validString($last))
        {
            $errors['name'] = "Required: name must be all letters.";
        }

        if(empty($gender)) {
            $errors['gender'] = "Required";
        }

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
    print_r($_POST);
    if(isset($_POST['submit'])) {
        $state = $_POST['state'];
        $email = $_POST['email'];
        $seeking = $_POST['seeking'];
        $biography = $_POST['biography'];
        $errors = $_POST['errors'];
        $success = $_POST['success'];



        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Required: must be a valid email.";
        }

        if($state=="--Select--") {
            $errors['state'] = "Required: choose a state";
        }

        if(empty($seeking)) {
            $errors['seeking'] = "Required";
        }

        if($success) {
            //redirect
            $f3->route('GET /interest');
        }

        $f3->set('state', $state);
        $f3->set('email', $email);
        $f3->set('seeking', $seeking);
        $f3->set('biography', $biography);
        $f3->set('errors', $errors);
        $f3->set('success', $success);
     //   $f3->set('phone', $_POST['phone']);

        $_SESSION['state'] = $state;
        $_SESSION['email'] = $email;
        $_SESSION['seeking'] = $seeking;
        $_SESSION['biography'] = $biography;

}
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