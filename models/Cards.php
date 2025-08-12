<?php

class Card
{
    private $id;
    private $title;
    private $listId;
    private $isArchived;
    private $position;
    private $description;
    private $createdBy;

    public function __construct($id = null, $title = null, $description = null, $listId = null, $isArchived = 0, $position = null, $createdBy = null)
    {
        $this->id         = $id;
        $this->title      = $title;
        $this->listId     = $listId;
        $this->isArchived = $isArchived;
        $this->position   = $position;
        $this->description = $description;
        $this->createdBy  = $createdBy;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function toArray()
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'list_id'    => $this->listId,
            'is_archived' => $this->isArchived,
            'position'   => $this->position,
            'description' => $this->description,
            'created_by'  => $this->createdBy
        ];
    }
}  