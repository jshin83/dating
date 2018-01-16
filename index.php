<?php
/**
 * Created by PhpStorm.
 * User: JenShin
 * Date: 1/16/18
 * Time: 11:59 AM
 */

//require the autoload file
require_once ('vendor/autoload.php');



//create an instance of Base class
$f3 = Base::instance();

$f3->set('DEBUG', 3);

//define page route
$f3->route('GET /', function() {
    //echo '<h1>This is default</h1>'; //testing purposes

    $view = new View();
    echo $view -> render('pages/home.hmtl');
}
);