<?php
namespace App\Entity;

final class Dictionary  extends Volume {
    private string $editor;

    public function __construct(string $editor, string $auteur, string $title)
    {
        parent::__construct($title, $auteur);
        $this->editor = $editor;
    }

    /**
     * Get the value of editor
     */ 
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set the value of editor
     *
     * @return  self
     */ 
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }
}