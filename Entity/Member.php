<?php

namespace App\Entity;

use App\Interface\UserInterface;

abstract class Member implements UserInterface
{

    private string $id;
    private string $lastname;
    private string $firstname;


    public function __construct(string $l, string $f)
    {
        $this->lastname = $l;
        $this->firstname = $f;

        $this->id = random_int(1, 99999);
    }


    /**
     * Get the value of id
     */
    public function getId()
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
}
