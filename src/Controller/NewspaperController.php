<?php

namespace App\Controller;

use App\Entity\NewsPaper;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

final class NewspaperController extends AbstractController
{
    public array $NEEDLES = ['title' => '', 'release_date' => '',];

    public function showOne(string $sId)
    {
        $sId = (int) $sId;

        $em = EntityManagerHelper::getEntityManager();
        $repository = new EntityRepository($em, new ClassMetadata("App\Entity\NewsPaper"));
        $oNewspaper = $repository->find($sId);
       
        print($this->serialize($oNewspaper, "json"));
    }

    public function add() :void
    {
        $posts = $_POST;
        foreach ($this->NEEDLES as $key => $value) {
            try {
                if (!array_key_exists($key, $posts)) {
                    throw new \Exception("No key $key found");
                }

                $this->NEEDLES[$key] = htmlentities(strip_tags($posts[$key]));

                if (empty($this->NEEDLES[$key])) {
                    throw new \Exception("key $key becomes empty , due to not allowed char");
                }
            } catch (\Throwable $e) {
                exit($e->getMessage());
            }
        }
        print($this->NEEDLES['release_date']);
        var_dump(\DateTime::createFromFormat("d-M-Y H:i:s" ,$this->NEEDLES['release_date']));
        die('---END---');
        $book = new NewsPaper($this->NEEDLES['title'], \DateTimeImmutable::createFromFormat("d-M-Y H:i:s", \DateTime::createFromFormat("d-M-Y H:i:s" ,$this->NEEDLES['release_date'])));
        $entityManager = EntityManagerHelper::getEntityManager();
        $entityManager->persist($book);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant l'ajout du journal en base de donnée.");
        }

        $entityManager = EntityManagerHelper::getEntityManager();
        $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Newspaper"));
        print($this->serialize($bookRepository->findBy(['title' => $this->NEEDLES['title']], ['id' => 'DESC'], 1, 0), 'json'));
    }

    public function modify(?int $iUserID) :void
    {
        $puts = $this->getPutFromRequest();
        foreach ($this->NEEDLES as $key => $value) {
            try {
                if (!array_key_exists($key, $puts)) {
                    throw new \Exception("No key $key found");
                }
                
                $this->NEEDLES[$key] = htmlentities(strip_tags($puts[$key]));
                
                if (empty($this->NEEDLES[$key])) {
                    throw new \Exception("key $key becomes empty , due to not allowed char");
                }
            } catch (\Throwable $e) {
                exit($e->getMessage());
            }
        }
        $entityManager = EntityManagerHelper::getEntityManager();
        $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Newspaper"));
        $book = $bookRepository->find($iUserID);

        $book->setTitle($this->NEEDLES['title'])->setAuthor($this->NEEDLES['author']);
        
        $entityManager->persist($book);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant la modification du livre en base de donnée.");
        }

        print($this->serialize($bookRepository->find($iUserID), 'json'));
    }
}
