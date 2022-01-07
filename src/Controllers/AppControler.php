<?php

namespace App\Controllers;

use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Visitor;
use App\Helpers\EntityManagerHelper;
use Exception;

class AppControler
{

    public  static function  index()
    {
        $em = EntityManagerHelper::getEntityManager();

        $visitor = new Visitor("DUPONT", "Jean", 39472943208);
        $em->persist($visitor);


        $book = new Book("ET télépRRRhone maison", "Warner");
        $em->persist($book);

        $borrow = new Borrow(new \DateTime(), $visitor, $book);

        $em->persist($borrow);

        try {
            $em->flush();
        } catch (\Throwable $th) {
            self::SendMail();
        }
    }

    private static function SendMail() {
        try {
            if (!mail("api6@loryleticee.fr", "Toto", "Message")) {
                throw new Exception("Attention erreur");
            }
        } catch (\Throwable $th) {
            print($th);
        }
    }
}
