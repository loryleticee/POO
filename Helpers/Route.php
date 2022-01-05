<?php 
namespace App\Helpers;

class Route {
    private $tutu;

    public function __construct()
    {
        $this->tutu = "toto";
    } 

    public static function redirect(string $url) : void
    {
        header("location: ".$url);
        exit();
    }
}

