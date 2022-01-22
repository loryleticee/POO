<?php
namespace App\Controller;

use App\Entity\Visitor;
use App\Helpers\EntityManagerHelper as Em;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

final class VisitorController extends AbstractController
{
    public array $NEEDLES = ['lastname' => '', 'firstname' => '', 'piece_ident' => ''];

    public function index() :void
    {
        try {
            $entityManager = Em::getEntityManager();
            $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
            print($this->serialize($visitorRepository->findAll()));
        } catch (\Throwable $e) {
            exit("Une erreur est survenu lors de la récupération des visiteurs.");
        }
    }

    public function add(?array $posts = []) :void
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

        $visitor = new Visitor($this->NEEDLES['lastname'], $this->NEEDLES['firstname'], $this->NEEDLES['piece_ident']);

        $entityManager = Em::getEntityManager();
        $entityManager->persist($visitor);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant l'ajout du visiteur en base de donnée.");
        }

        $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
        print($this->serialize($visitorRepository->findBy(['lastname' => $this->NEEDLES['lastname']], ['id' => 'DESC'], 1, 0)));
    }

    public function modify(?int $iUserID, ?array $puts = []) :void
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
        $entityManager = Em::getEntityManager();
        $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
        $visitor = $visitorRepository->find($iUserID);

        $visitor->setFirstname($this->NEEDLES['firstname'])->setLastname($this->NEEDLES['lastname'])->setPieceIdent($this->NEEDLES['piece_ident']);

        $entityManager->persist($visitor);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant la modification du visiteur en base de donnée.");
        }

        print($this->serialize($visitorRepository->find($iUserID)));
    }
}
