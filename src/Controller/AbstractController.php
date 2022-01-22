<?php

namespace App\Controller;
session_start();

use Router\Router;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class AbstractController
{
    const PUTS_METHOD = [
        'application/json',
        'application/x-www-form-urlencoded'
    ];

    public function setHeader()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json; charset=utf-8');
    }

    public static function getSerializer()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }

    public function serialize(array|object $datas)
    {
        $this->setHeader();
        return $this->getSerializer()->serialize($datas, "json");
    }

    public function getPutFromRequest() {
        $put_datas = [];
        try {
            $puts = $this->IsGoodFormatedPutRequest();
            if(!is_resource($puts)) {
                throw new \Exception("this PUT requests is malformed");
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
        
        $putdata='';
        while ($data = fread($puts, $CHUNK = 1024)) { 
            $putdata .= $data;
        }
        parse_str($putdata, $result);
        $put_datas = $result;

        return $put_datas;  
    }
    
    private function IsGoodFormatedPutRequest()
    {
        $_PUTS = false;
        if ($_SERVER["REQUEST_METHOD"] === "PUT") {
            if(!array_key_exists("CONTENT_TYPE", $_SERVER)) {
                exit("No data founds, please send datas via ". self::PUTS_METHOD[0] . " or " . self::PUTS_METHOD[1]);
            }
            if(!in_array($_SERVER["CONTENT_TYPE"], self::PUTS_METHOD)) {
                exit("This body setting is not allowed please choose " . self::PUTS_METHOD[0] . " or " . self::PUTS_METHOD[1]);
            }
            $_PUTS= fopen("php://input", "r"); 
        }

        return $_PUTS;
    }

    /**
     * Check if $inputs contains all keys in $needles
     * @param array $inputs array of datas to checks
     * @param array $needles array of keys required
     * @param string $url path for where redirect user on failure
     * 
     * @return array inputs array cleaned from htmlchars
     */
    public function validate(array $inputs = [], array $needles = [], string $url = "") : array
    {
        foreach ($needles as $value) {
            if(!array_key_exists($value, $inputs)) {
                $_SESSION["error"] = "Il manque des champs à remplir";
                Router::redirect($url);
            }
            $inputs[$value] = htmlentities(strip_tags($inputs[$value]));
        }

        return $inputs;
    }
}
