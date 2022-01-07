<?php

namespace App\Controllers;

use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Library;
use App\Entity\Visitor;
use App\Models\AbstractRepository;

use Doctrine\ORM\Mapping\ClassMetadata;
use App\Helpers\EntityManagerHelper as Em;
use App\Helpers\SerializeHelper as Serializer;
use Laminas\Mail;

class AppController
{

    public static function index()
    {
        $entityManager = Em::getEntityManager();
        
        $visitor = new Visitor("DUPONT", "Jean", 39472943208);
        $entityManager->persist($visitor);
        
        // $library = new Library("Library JASOR");
        // $library->AddMember($visitor);
        
        
        // $book = new Book("Alice aux pays des merveilles", "Walt DISNEY");
        $book = new Book("ET télépRRRhone maison", "Warner");
        $entityManager->persist($book);
        

        $borrow1 = new Borrow( new \DateTime(), $visitor, $book);

        // $borrow1->setReturn_date(10, "week");
        $entityManager->persist($borrow1);
        
        $entityManager->flush();
        try {
        } catch (\Exception $err) {

        }
    }
    

}
