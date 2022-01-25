<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Helpers\EntityManagerHelper;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Router\Router;

session_start();

final class EmployeeController extends AbstractController{
    const NEEDLES = [
        "lastname",
        "firstname",
        "badge_number"
    ];

    public function show()
    {
        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\Employee"));
        $employees = $repository->findAll();

        include (__DIR__."/../vues/Employee/showEmployees.php");
    }
    
    public function add()
    {
        if (!empty($_POST)) {
            foreach (self::NEEDLES as $value) {
                if(!array_key_exists($value, $_POST)) {
                    $error = "Il manque des champs à remplir";
                    include_once(__DIR__."/../vues/addEmployee.php");
                    exit;
                }
                $_POST[$value] = htmlentities(strip_tags($_POST[$value]));
            }

            $badge_number = (int) $_POST["badge_number"];
            $employee = new Employee($_POST["lastname"], $_POST["firstname"], $badge_number);

            $em = EntityManagerHelper::getEntityManager();
            $em->persist($employee);
            $em->flush(); 
            
        }

        include_once(__DIR__."/../vues/Employee/addEmployee.php");
    }
    
    public function modify(string $sId)
    {  
        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\Employee"));

        $employee = $repository->find($sId);
        
        if (!empty($_POST)) {
            foreach (self::NEEDLES as $value) {
                if(!array_key_exists($value, $_POST)) {
                    $error = "Il manque des champs à remplir";
                    include_once(__DIR__."/../vues/Employee/modifyEmployee.php");
                    exit;
                }
                $_POST[$value] = htmlentities(strip_tags($_POST[$value]));
            }

            $employee->setLastname($_POST["lastname"]);
            $employee->setFirstname($_POST["firstname"]);
            $employee->setBadgeNumber((int)$_POST["badge_number"]);

            $em->persist($employee);
            $em->flush();        
        }
   
        $employeeDatas = []; 
        $employeeDatas["id"] = $employee->getId();

        foreach (self::NEEDLES as $value) {
            $getteur = "get". ucfirst($value);
            if($value === "badge_number") {
                $getteur = "getBadgeNumber";
            }
            $employeeDatas[$value] = $employee->$getteur();
        }

        include_once(__DIR__."/../vues/Employee/modifyEmployee.php");
    }

    public function delete( $sId)
    {
        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\Employee"));
        $employee = $repository->find($sId);
        $em->remove($employee);
        $em->flush();
    }

}