<?php

class Card
{
    private $id;
    private $title;
    private $listId;
    private $isArchived;
    private $position;

    public function __construct($id = null, $title = null, $listId = null, $isArchived = 0, $position = null)
    {
        $this->id         = $id;
        $this->title      = $title;
        $this->listId     = $listId;
        $this->isArchived = $isArchived;
        $this->position   = $position;
    }

    // --- Getters ---
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getListId()
    {
        return $this->listId;
    }

    public function getIsArchived()
    {
        return $this->isArchived;
    }

    public function getPosition()
    {
        return $this->position;
    }

    // --- Setters ---
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setListId($listId)
    {
        $this->listId = $listId;
    }

    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }
}  