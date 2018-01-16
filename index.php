<?php
/**
 * Created by PhpStorm.
 * User: JenShin
 * Date: 1/16/18
 * Time: 11:59 AM
 */

//define page1 route
$f3->route('GET /', function() {
    //echo '<h1>This is default</h1>'; //testing purposes

    $view = new View();
    echo $view -> render('pages/home.hmtl');
}
);