<?php 

namespace App;

require_once('vendor/autoload.php');

use Router\Router;

const PUTS_METHOD = [
    'application/json',
    'application/x-www-form-urlencoded'
];
$_PUTS='';
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    if(!array_key_exists("CONTENT_TYPE", $_SERVER)) {
        exit("NEED BODY ");
    }
    if(!in_array($_SERVER["CONTENT_TYPE"], PUTS_METHOD)) {
        exit("no");
    }
    $_PUTS= fopen("php://input", "r"); 
}

$router = new Router($_GET['url'], $_PUTS , $_POST);

$router->get("/", "App\Controller\AppController@index");

$router->get("/books" , "App\Controller\BookController@index");
$router->post("/book" , "App\Controller\BookController@add");
$router->put("/book/:id" , "App\Controller\BookController@modify");

$router->get("/visitors" , "App\Controller\VisitorController@index");
$router->post("/visitor" , "App\Controller\VisitorController@add");
$router->put("/visitor/:id" , "App\Controller\VisitorController@modify");

$router->run();
