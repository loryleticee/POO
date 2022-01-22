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
    
    public function add()
    {
        $this->validate($_POST, self::NEEDLES);

        $badge_number = (int) $_POST["badge_number"];
        $employee = new Employee($_POST["lastname"], $_POST["firstname"], $badge_number);

        $em = EntityManagerHelper::getEntityManager();
        $em->persist($employee);
        $em->flush();

        Router::redirect("src/vues/addEmployee.php");
    }
    
    public function modify(string $sId)
    {  
        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\Employee"));

        $employee = $repository->find($sId);
        
        if (!empty($_POST)) {
            $this->validate($_POST, self::NEEDLES, "src/vues/modifyEmployee.php");
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
        $_SESSION["employeeDatas"] = $employeeDatas;
        
        Router::redirect("src/vues/modifyEmployee.php");
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