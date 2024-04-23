<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once ('vendor/autoload.php');

//instantiate F3 base class
$f3 = Base::instance();

//define a default route
$f3->route('GET /', function(){
    //echo '<h1>This is my pets2 page!!!</h1>';

    //render a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//define a route for /order
$f3->route('GET|POST /order', function($f3){
    //echo '<h1>THIS IS MY ORDER PAGE</h1>';

    //check if the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //get data from post
        $pet = $_POST['pet'];
        $color = $_POST['color'];

        //save data in session
        $f3->set('SESSION.pet', $pet);
        $f3->set('SESSION.color', $color);

        //route to summary page
        $f3->reroute('summary');
    }
    //render a view
    $view = new Template();
    echo $view->render('views/pet-order.html');
});

//define a route for summary
$f3->route('GET /summary', function($f3){


    //render a view
    $view = new Template();
    echo $view->render('views/order-summary.html');
});

//run fat-free
$f3->run();