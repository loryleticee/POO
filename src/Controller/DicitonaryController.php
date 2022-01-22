<?php

namespace App\Controller;

use App\Helpers\EntityManagerHelper;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class DicitonaryController  extends AbstractController
{

    public function showOne(string $sId)
    {
        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\Dictionary"));

        $this->serialize($repository->find((int) $sId));
    }

    public function show()
    {
        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\Dictionary"));

        $this->serialize($repository->findAll());
    }
}
