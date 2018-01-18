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

//set default path to page/home
$f3->route('GET /', function() {
    $view = new Template();
    echo $view -> render('pages/home.html');
}
);
//run fat free
$f3->run();