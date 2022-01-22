<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class NewsPaper extends Document {

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeImmutable $release_date;

    public function __construct(string $title, \DateTimeImmutable $d)
    {
        parent::__construct($title);
        $this->release_date = $d;
    }


    /**
     * Get the value of release_date
     *
     * @return \DateTimeImmutable
     */
    public function getReleaseDate(): \DateTimeImmutable
    {
        return $this->release_date;
    }
}