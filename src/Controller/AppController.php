<?php

namespace App\Controller;

use Router\Router;

final class AppController extends AbstractController
{
    const NEEDLES = ['login' => '', 'password' => '',];

    public function index(): void
    {
        print_r($this->serialize(["Home" => "Hello World"], 'json'));
    }

    public function error404(): void
    {
        Router::redirect("404");
    }
    public function login()
    {
        if (!empty($_POST)) {
            $posts = $this->validate($_POST, self::NEEDLES, "/vues/login.php");
            foreach ($this->NEEDLES as $value) {
                try {
                    if (!array_key_exists($value, $posts)) {
                        throw new \Exception("No value $value found");
                    }

                    $this->NEEDLES[$value] = htmlentities(strip_tags($posts[$value]));

                    if (empty($this->NEEDLES[$value])) {
                        throw new \Exception("Key $value becomes empty , due to not allowed char");
                    }
                } catch (\Throwable $e) {
                    exit($e->getMessage());
                }
            }
            Router::redirect('home');
        }

        include(__DIR__ . "/../vues/Auth/login.php");
    }
}
