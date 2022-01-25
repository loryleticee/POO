<?php

namespace App\Entity;

use App\Interface\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"visitor" = "Visitor", "employee" = "Employee"})
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="unique_visitor_details", columns={"piece_ident", "badge_number"})})
 */
class Member implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    
    /**
     * @ORM\Column(length="100")
    */
    protected string $lastname;
    
    /**
     * @ORM\Column(length="100")
    */
    protected string $firstname;

    protected static $nbrMember; 

    /**
     *@param string $l The lastname
     *@param string $f The firstname
     */
    public function __construct(string $l, string $f)
    {
        $this->lastname = $l;
        $this->firstname = $f;

        self::$nbrMember = self::$nbrMember + 1;
    }

    public static function getNumber()
    {
        return self::$nbrMember;
    }


    /**
     * Get the value of id
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function returnBook(): void
    {
    }

    public function borrowBook(Book $book)
    {
        
    }

}
