<?php

namespace App\Entity;

final class Library
{
    private array $memberList = [];
    private array $documentList = [];
    
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function addMember(Member $member): self
    {
        array_push($this->memberList, $member);

        return $this;
    }

    public function removeMember(Member $member): self
    {
        foreach ($this->memberList as $key => $mem) {
            if ($member->getId() ===  $mem->getId()) {
                unset($this->memberList[$key]);
            }
        }

        return $this;
    }

    public function AddDocument(Document $document) : self
    {
        array_push($this->documentList, $document);

        return $this;
    }

    public function removeDocument(Document $document) {
        foreach ($this->documentList as $key => $value) {
            if($document->getTitle() === $value->getTitle()){
                unset($this->documentList[$key]);
            }
        }
    }

    /**
     * Get the value of memberList
     */ 
    public function getMemberList() : array
    {
        return $this->memberList;
    }

    /**
     * Get the value of documentList
     */ 
    public function getDocumentList() : array
    {
        return $this->documentList;
    }

}
