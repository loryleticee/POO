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
        
        try {
            $entityManager->flush();
        } catch (\Exception $err) {
            print("Une erreur s'est produite, veuillez vérifier vos mails pour plus de détails");
            $mail = new Mail\Message();
            $mail->setBody("$err");
            $mail->setFrom('infos@loryleticee.fr', "S");
            $mail->addTo('api6@loryleticee.fr', 'Name of recipient');
            $mail->setSubject('TestSubject');
            
            $transport = new Mail\Transport\Sendmail();
            $transport->send($mail);
        }
    }
    
    public function ShowVisitors()
    {
        $entityManager = Em::getEntityManager();
        $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
        echo (Serializer::getSerializer()->serialize($visitorRepository->findAll(), 'json'));
    }

    public function ShowBorrows()
    {
        $entityManager = Em::getEntityManager();
        $borrowRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Borrow"));
        echo (Serializer::getSerializer()->serialize($borrowRepository->findAll(), 'json'));
    }
}
