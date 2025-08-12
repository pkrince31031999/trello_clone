<?php

class Lists
{
    private $id;
    private $title;
    private $boardId;
    private $position;
    private $description;

    public function __construct($id = null, $title = null, $boardId = null, $position = null, $description = null)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->boardId  = $boardId;
        $this->position = $position;
        $this->description = $description;
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

    public function getBoardId()
    {
        return $this->boardId;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getDescription()
    {
        return $this->description;
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

    public function setBoardId($boardId)
    {
        $this->boardId = $boardId;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    // --- Utility: Convert to array ---
    public function toArray()
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'board_id'  => $this->boardId,
            'position'  => $this->position,
            'description' => $this->description
        ];
    }
}
