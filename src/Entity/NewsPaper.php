<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Newspaper extends Document {

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $release_date;

    public function __construct(string $title, \DateTime $d)
    {
        parent::__construct($title);
        $this->release_date = $d;
    }


    /**
     * Get the value of release_date
     *
     * @return \DateTime
     */
    public function getReleaseDate(): \DateTime
    {
        return $this->release_date;
    }

    /**
     * Set the value of release_date
     *
     * @param \DateTime $release_date
     *
     * @return self
     */
    public function setReleaseDate(\DateTime $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }
}