<?php

class Boards
{
    private $id;
    private $name;
    private $description;
    private $createdBy;
    private $isArchived;

    public function __construct($id = null, $name = null, $description = null, $createdBy = null, $isArchived = 0)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->createdBy   = $createdBy;
        $this->isArchived  = $isArchived;
    }

    // --- Getters ---
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getIsArchived()
    {
        return $this->isArchived;
    }

    // --- Setters ---
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;
    }

    // --- Utility: Convert to array ---
    public function toArray()
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'created_by'  => $this->createdBy,
            'is_archived' => $this->isArchived
        ];
    }
}
