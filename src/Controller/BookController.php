<?php
namespace App\Controller;

use App\Entity\Book;
use App\Helpers\EntityManagerHelper as Em;
use App\Helpers\SerializeHelper as Serializer;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class BookController
{
    public array $NEEDLES = ['title' => '', 'author' => '',];

    public function index()
    {
        try {
            $entityManager = Em::getEntityManager();
            $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Book"));
            // print(Serializer::getSerializer()->serialize($bookRepository->findAll(), 'json'));

            print(Serializer::getSerializer()->serialize($bookRepository->getGreaterThan(100), 'json'));

        } catch (\Throwable $e) {
            exit("Une erreur est survenu lors de la récupération des livres.");
        }
    }

    public function add(?array $posts = [])
    {
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

        $book = new Book($this->NEEDLES['title'], $this->NEEDLES['author']);
        $entityManager = Em::getEntityManager();
        $entityManager->persist($book);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant l'ajout du livre en base de donnée.");
        }

        $entityManager = Em::getEntityManager();
        $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Book"));
        print(Serializer::getSerializer()->serialize($bookRepository->findBy(['title' => $this->NEEDLES['title']], ['id' => 'DESC'], 1, 0), 'json'));
    }

    public function modify(?int $iUserID, ?array $puts = [])
    {
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
        $entityManager = Em::getEntityManager();
        $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Book"));
        $book = $bookRepository->find($iUserID);

        $book->setTitle($this->NEEDLES['title'])->setAuthor($this->NEEDLES['author']);
        
        $entityManager->persist($book);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant la modification du livre en base de donnée.");
        }

        print(Serializer::getSerializer()->serialize($bookRepository->find($iUserID), 'json'));
    }
}
