<?php
namespace App\Entity;

abstract class Document {
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

        /**
     * Get the value of name
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @return  self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

}