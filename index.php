<?php
/*
 * Created by PhpStorm.
 * User: JenShin
 * Date: 1/16/18
 * Time: 11:59 AM
 * index.php for dating website
 */

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

//set default path to page/home
$f3->route('GET /', function() {
    $view = new Template();
    echo $view -> render('pages/home.html');
}
);

//personal info page
$f3->route('GET /personal', function() {
    //echo '<h1>Form 1</h1>'; //testing purposes

    $view = new Template();
    echo $view -> render('pages/personal_info.html');
});

//profile page
$f3->route('GET|POST /profile', function() {
    //echo '<h1>Form 1</h1>'; //testing purposes

    $view = new Template();
    echo $view -> render('pages/profile.html');
});

//interests
$f3->route('GET|POST /interests', function() {
    //echo '<h1>Form 1</h1>'; //testing purposes

    $view = new Template();
    echo $view -> render('pages/interests.html');
});

//run fat free
$f3->run();