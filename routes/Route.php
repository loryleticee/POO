<?php

namespace Router;

class Route {
    public string $path;
    public string $action;
    public array  $posts;
    public array  $matches;

    public function __construct( string $path, string $action,?array $puts = [], ?array $posts = [])
    {
        $this->path = trim($path, '/');  
        $this->action = $action;  
        $this->posts = $posts;  
        $this->puts = $puts;  
    }

    public function matches(string $url)
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)' , $this->path);
        $pathToMatch = "#^$path$#";
        
        if(preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;  
            return true;
        } else {
            return false;
        }
    }

    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0]();
        $method = $params[1];
        if(count($this->posts)) {
            return $controller->$method($this->posts);
        }
        if(count($this->puts)) {
            return $controller->$method($this->matches[1], $this->puts);
        }
        
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }

}




