<?php 
namespace App;

require_once('vendor/autoload.php');

use Router\Router;

$router = new Router($_GET['url']);

$router->get("/", "App\Controller\AppController@index");

$router->get("/books" , "App\Controller\BookController@index");
$router->post("/book" , "App\Controller\BookController@add");
$router->put("/book/:id" , "App\Controller\BookController@modify");

$router->get("/visitors" , "App\Controller\VisitorController@index");
$router->post("/visitor" , "App\Controller\VisitorController@add");
$router->put("/visitor/:id" , "App\Controller\VisitorController@modify");

$router->post("/newspapers", "App\Controller\NewspaperController@show");
$router->post("/newspaper", "App\Controller\NewspaperController@add");
$router->get("/newspaper/:id", "App\Controller\NewspaperController@showOne");

$router->get("/dictionary/:id", "App\Controller\DicitonaryController@showOne");
$router->get("/dictionary", "App\Controller\DicitonaryController@show");

$router->post("/employee/:id", "App\Controller\EmployeeController@modify");
$router->get("/employee/:id", "App\Controller\EmployeeController@modify");
$router->post("/employee", "App\Controller\EmployeeController@add");

$router->run();




