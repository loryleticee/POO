<?php 
namespace App;
session_start();

// $_SESSION["permission"] = isset($_SESSION["level"]) ? $_SESSION["level"] : 0;

require_once('vendor/autoload.php');

use Router\Router;

$router = new Router($_GET['url']);

// if ($_SESSION["permission"] > 1)
$router->get("/", "App\Controller\AppController@login");
$router->post("/", "App\Controller\AppController@login");
$router->get("/home", "App\Controller\AppController@index");

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

$router->get("/employees", "App\Controller\EmployeeController@show");
$router->post("/employee/:id", "App\Controller\EmployeeController@modify");
$router->get("/employee/:id", "App\Controller\EmployeeController@modify");
$router->post("/employee", "App\Controller\EmployeeController@add");
$router->get("/employee", "App\Controller\EmployeeController@add");

$router->get("/borrow", "App\Controller\BorrowController@addBorrow");
$router->post("/borrow", "App\Controller\BorrowController@addBorrow");

$router->get("/borrow/:id", "App\Controller\BorrowController@modify");
$router->post("/borrow/:id", "App\Controller\BorrowController@modify");

$router->get("/lahaine", "App\Controller\BorrowController@addFake");

$router->get("/library", "App\Controller\LibraryController@addLibrary");
$router->post("/library", "App\Controller\LibraryController@addLibrary");

$router->get("/library/:id", "App\Controller\LibraryController@modifyLibrary");
$router->post("/library/:id", "App\Controller\LibraryController@modifyLibrary");

$router->get("/deletelibrary/:id", "App\Controller\LibraryController@deleteLibrary");

$router->run();




