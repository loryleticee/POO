<?php
namespace App\Controller;

use Router\Router;

final class AppController extends AbstractController
{
    public function index(): void
    {
        print_r($this->serialize(["Home" => "Hello World"], 'json'));
    }

    public function error404(): void
    {
        Router::redirect("404");
    }
}
