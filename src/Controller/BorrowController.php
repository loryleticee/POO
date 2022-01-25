<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Entity\Bd;
use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Dictionary;
use App\Entity\Employee;
use App\Entity\Newspaper;
use App\Entity\Visitor;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class BorrowController extends AbstractController
{

    const BORROWTABLE = [
        "date", "member", "book"
    ];

    public function index()
    {
        $em = EntityManagerHelper::getEntityManager();

        // $this->addFake($em);

        $borrowRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Borrow"));
        $borrows = $borrowRepository->findAll();

        foreach ($borrows as $borrow) {
            var_dump($borrow->getMember()->getLastname());
        }
    }

    public function addBorrow()
    {
        if (empty($_POST)) {
            include __DIR__ . "/../vues/Borrow/add.php";
            die();
        }

        foreach (self::BORROWTABLE as $value) {

            $_POST[$value] = htmlentities(strip_tags(trim($_POST[$value])));
            if ($_POST[$value] === "") {
                $error = "Le Champs doit être remplie";
                include __DIR__ . "/../vues/Borrow/add.php";
                echo $error;
            }
            if (!array_key_exists($value, $_POST)) {
                $error = "Le Champs doit être remplie";
                include __DIR__ . "/../vues/Borrow/add.php";
                echo $error;
            }
        }
        $em = EntityManagerHelper::getEntityManager();
        $memberRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Member"));
        $member = $memberRepository->find($_POST["member"]);
        $bookRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Book"));
        $book = $bookRepository->find($_POST["book"]);
        $borrow = new Borrow(new DateTime(), $member, $book);
        $em->persist($borrow);
        $em->flush();
    }

    public function addFake()
    {
        $em = EntityManagerHelper::getEntityManager();

        $book = new Book("La Haine", "toto");
        $em->persist($book);



        // $newspaper = new Newspaper("Le MOnde article 4", new \DateTime());
        // $em->persist($newspaper);

        // $bd = new Bd("Ma BD", "Titeuf", "DUPREY");
        // $em->persist($bd);

        // $dico = new Dictionary("Editeur SOny", "GECKO", "Le larrousse");
        // $em->persist($dico);


        // $visitor = new Visitor("DUPONT", "Jean", 39472943208);
        // $em->persist($visitor);

        // $employee = new Employee("KING", "Alphonse", 98635);
        // $em->persist($employee);


        //  $borrow1 = new Borrow(new \DateTime(), $visitor, $book);
        //  $borrow2 = new Borrow(new \DateTime(), $employee, $book);

        //  $em->persist($borrow1);
        // $em->persist($borrow2);

        try {
            $em->flush();
        } catch (\Throwable $th) {
            exit("Be careful , you are trying to insert a data alreday present in the database.");
        }
    }

    public function modify(string $id)
    {
        $em = EntityManagerHelper::getEntityManager();
        $borrowRepository = new EntityRepository($em, new ClassMetadata("App\Entity\Borrow"));
        $memberRepository = new EntityRepository($em, new ClassMetadata("App\Entity\Member"));
        $bookRepository = new EntityRepository($em, new ClassMetadata("App\Entity\Book"));

        $oBorrow = $borrowRepository->find($id);

        if (!empty($_POST)) {
            foreach (self::BORROWTABLE as $value) {
                $existe = array_key_exists($value, $_POST);
                if ($existe === false) {
                    echo "Paramètre $value manquant";
                    include __DIR__ . "/../vues/Borrow/modify.php";
                    die();
                }

                $_POST[$value] = trim(htmlentities(strip_tags($_POST[$value])));

                if ($_POST[$value] === "") {
                    echo "Champs $value vide";
                    include __DIR__ . "/../vues/Borrow/modify.php";
                    die();
                }
            }
            
            // $_POST ["date"] = htmlentities( strip_tags( $_POST["date"]) ); //idem ligne 128
            // $_POST ["member"] = htmlentities($_POST["member"]);
            // $_POST ["book"] = htmlentities($_POST["book"]);
            
            if ($_POST["member"] !== $oBorrow->getMember()->getId()) {
                $oMember = $memberRepository->find($_POST["member"]);
                $oBorrow->setMember($oMember);
            }
            
            if ($_POST["book"] !== $oBorrow->getBook()->getId()) {
                $oBook = $bookRepository->find($_POST["book"]);
                $oBorrow->setbook($oBook);
            }

            if ($_POST["date"] !== $oBorrow->getBorrow_date()->format("Y-m-d")) {
                $oBorrow->setBorrow_date(DateTime::createFromFormat("Y-m-d", $_POST["date"]));
                
            }
            
            $em->persist($oBorrow);
            $em->flush();
        }

        include __DIR__ . "/../vues/Borrow/modify.php";
    }
}
