<?php

namespace Router;

use App\Controller\AppController;
use Router\Route;

class Router {
    public string $url;
    public array $routes = [];
    public array $posts = [];
    public array $puts = [];

    public function __construct(string $url, mixed $puts, ?array $posts = [])
    {
        $this->url = trim($url, '/');   
        
        if(is_resource($puts)) {
            $putdata='';
            while ($data = fread($puts, $CHUNK = 1024)) { 
                $putdata .= $data;
            }
            parse_str($putdata, $result);
            
            if(count($result)) {
                $this->puts = $result;
            }
        }

        if($posts) {
            $this->posts = $posts;
        }
    } 

    public function get(string $path, string $action)
    { 
        $this->routes["GET"][] = new Route($path, $action);
    }
    public function post(string $path, string $action)
    { 
        $this->routes["POST"][] = new Route($path, $action, null, $this->posts);
    }

    public function put(string $path, string $action)
    { 
        $this->routes["PUT"][] = new Route($path, $action, $this->puts);
    }

    public function run()
    { 
        $routeFound = false;

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->matches($this->url)) {
                $routeFound = true;
                $route->execute();
            }
        }

        if (!$routeFound) {
            return (new AppController())->error404();
        }
    }

    public static function redirect(string $url) {
        header("location: ". $_SERVER["REQUEST_SCHEME"]. "://". $_SERVER["HTTP_HOST"] .  "/" . $url);
        exit();
    }
}