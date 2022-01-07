<?php
namespace App\Helpers;

class EntityManagerHelper {
    public static function getEntityManager()
    {
        require_once('bootstrap.php');

        return $entityManager;
    }
}