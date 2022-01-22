<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Employee extends Member
{

    /**
     * @ORM\Column(type="integer")
     */
    private int $badge_number;


    /**
     *@param string $l The lastname
     *@param string $f The firstname
     *@param int $b_n The badge number
     */
    public function __construct(string $l, string $f, int $b_n)
    {
        parent::__construct($l, $f);
        $this->badge_number = $b_n;
    }


    public function borrowBook(Book $book): void
    {
    }

    /**
     * Get the value of badge_number
     *
     * @return int
     */
    public function getBadgeNumber(): int
    {
        return $this->badge_number;
    }

    /**
     * Set the value of badge_number
     *
     * @param int $badge_number
     *
     * @return self
     */
    public function setBadgeNumber(int $badge_number): self
    {
        $this->badge_number = $badge_number;

        return $this;
    }
}
