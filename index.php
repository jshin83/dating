<?php
/*
 * This is the controller for a dating website.
 * Date: 1/16/18
 * Time: 11:59 AM
 * index.php
 * @author Jen Shin <jshin@mail.greenriver.edu>
 * @copyright 2018
 */


//require the autoload file
require_once ('vendor/autoload.php');
session_start();


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
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $errors = $_POST['errors'];
        $member = "";

        include ('model/validate.php');
        if(!validPhone($phone))
        {
            $errors['phone'] = "Please enter a 10 digit phone number (dashes are okay).";
        }

        if(!validAge($age))
        {
            $errors['age'] = "Please enter all numbers - must be 18 or older.";
        }

        if(!validString($first))
        {
            $errors['firstName'] = "Required: name must be all letters.";
        }

        if(!validString($last))
        {
            $errors['lastName'] = "Required: name must be all letters.";
        }

        if(empty($gender)) {
            $errors['gender'] = "Required";
        }

        $name = $first.' '.$last;

        $success = $_POST['success'];

        //$errors = validatePersonalInfo($name, $age, $phone, $gender);

        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        $f3->set('errors', $errors);
        $f3->set('success', $success);
        //$f3->set('premium', $premium);


/*
        $_SESSION['name'] = $name;
        $_SESSION['age'] = $age;
        $_SESSION['gender'] = $gender;
        $_SESSION['phone'] = $phone;
*/

        $success = (sizeof($errors) == 0);

        if($success) {
            //save profile object to session

            if(isset($_POST['premium'])) {
                //instantiate Premium Member
                $member = new PremiumMember($first, $last, $age, $gender, $phone);
            } else {
                //instantiate Member
                $member = new Member();
            }
            $_SESSION['member'] = $member;

            //redirect to profile
            $f3->reroute('@profile');
        }
    }

    $view = new Template();
    echo $view -> render('pages/personal_info.html');
});

//profile page
$f3->route('GET|POST @profile: /profile', function($f3) {
    //testing only
    $member = $_SESSION['member'];

    print_r($member);

    if(isset($_POST['submit'])) {
        $state = $_POST['state'];
        $email = $_POST['email'];
        $seeking = $_POST['seeking'];
        $biography = htmlspecialchars($_POST['biography']);
        $errors = $_POST['errors'];


        include ('model/validate.php');

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

        if(empty($biography)) {
            $errors['biography'] = "Required";
        }

        $success = $_POST['success'];

        $f3->set('state', $state);
        $f3->set('email', $email);
        $f3->set('seeking', $seeking);
        $f3->set('biography', $biography);
        $f3->set('errors', $errors);
        $f3->set('success', $success);
/*
        $_SESSION['state'] = $state;
        $_SESSION['email'] = $email;
        $_SESSION['seeking'] = $seeking;
        $_SESSION['biography'] = $biography;
*/
        $success = (sizeof($errors) == 0);

        if($success) {

            if ($member instanceof PremiumMember) {
                $member -> setState($state);
                $member -> setEmail($email);
                $member -> setSeeking($seeking);
                $member -> setBio($biography);
                $_SESSION['member'] = $member;

                //redirect to interests
                $f3->reroute('@interests');
            } else {
                $member -> setState($state);
                $member -> setEmail($email);
                $member -> setSeeking($seeking);
                $member -> setBio($biography);
                $_SESSION['member'] = $member;

                //skip interests, route to results
                $f3->reroute('@results');
            }
        }
}
    $view = new Template();
    echo $view -> render('pages/profile.html');
});

//interests
$f3->route('GET|POST @interests: /interests', function($f3) {
    //print_r($_POST);
    //testing only
    $member = $_SESSION['member'];

    print_r($member);

    if(isset($_POST['submit'])) {
        $indoorInterests = $_POST['indoorList'];
        $outdoorInterests = $_POST['outdoorList'];
        $errors = $_POST['errors'];

        include ('model/validate.php');

        if(empty($_POST['indoorList']) && empty($_POST['outdoorList'])) {
            $errors['emptyInterests'] = "Please choose atleast one interest from each category.";
        } else if(empty($_POST['indoorList']) || empty($_POST['outdoorList'])) {
            $errors['oneEmpty'] = "Please choose atleast one interest from each category**.";
        } else {

            if (!validOutdoor($outdoorInterests)) {
                $errors['outdoor'] = "Choose from the outdoor options provided.";
            }

            if (!validIndoor($indoorInterests)) {
                $errors['indoor'] = "Choose from the indoor options provided.";
            }
        }
        $success = $_POST['success'];

        $f3->set('indoorInterests', $indoorInterests);
        $f3->set('outdoorInterests', $outdoorInterests);
        $f3->set('errors', $errors);
        $f3->set('success', $success);

        $_SESSION['indoorInterests'] = $indoorInterests;
        $_SESSION['outdoorInterests'] = $outdoorInterests;


        $success = (sizeof($errors) == 0);

        if($success) {
            //redirect to results
            $f3->reroute('@results');
        }
    }
    $view = new Template();
    echo $view -> render('pages/interests.html');
});

//results
$f3->route('GET|POST @results: /results', function() {
    //testing only
    $member = $_SESSION['member'];

    print_r($member);

    $view = new Template();
    echo $view -> render('pages/results.html');
});

//run fat free
$f3->run();