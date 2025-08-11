<?php

class ListModel
{
    private $id;
    private $title;
    private $boardId;
    private $position;

    public function __construct($id = null, $title = null, $boardId = null, $position = null)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->boardId  = $boardId;
        $this->position = $position;
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

    // --- Utility: Convert to array ---
    public function toArray()
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'board_id'  => $this->boardId,
            'position'  => $this->position
        ];
    }
}
