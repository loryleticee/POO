<?php

namespace App\Controller;

use App\Entity\Library;
use App\Helpers\EntityManagerHelper;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Laminas\Code\Generator\EnumGenerator\Name;

class LibraryController 
{
    public function addLibrary() 
    {
        
        
        $em = EntityManagerHelper::getEntityManager();
        
        if (!empty($_POST["name"])){
            $name = strip_tags($_POST["name"]);
            if (trim($_POST["name"]) === "") {
                
                $error = "La Champ doit être remplie";
                echo $error;
                die ();
            }
            
            $library = new Library($name);
            
            $em->persist($library);
            $em->flush();
            
            
        }
        
        include (__DIR__ . "/../vues/Library/addLibrary.php");
    }

    public function modifyLibrary(string $sId)
    {
        $em = EntityManagerHelper::getEntityManager();
        $repository = New EntityRepository($em, new ClassMetadata("App\Entity\Library"));

        $obj = $repository -> find($sId);

        
        if (!empty($_POST["name"])){
            $name = strip_tags($_POST["name"]);
            if (trim($_POST["name"]) === "") {
                
                $error = "La Champ doit être remplie";
                echo $error;
                die ();
            }
            
            $obj->setName($name);
            
            $em->persist($obj);
            $em->flush();
        }        
        
        
        include __DIR__."/../vues/Library/modifyLibrary.php" ;
    }

    public function deleteLibrary($sId)
    {
        $em = EntityManagerHelper::getEntityManager();
        $repository = New EntityRepository($em, new ClassMetadata("App\Entity\Library"));

        $obj = $repository -> find($sId);

        $em->remove($obj);

        $em->flush();
    }
}