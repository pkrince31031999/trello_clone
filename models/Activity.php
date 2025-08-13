<?php

class Activity
{
    private $id;
    private $cardId;
    private $userId;
    private $date;

    public function __construct($id = null, $cardId = null, $userId = null, $date = null)
    {
        $this->id = $id;
        $this->cardId = $cardId;
        $this->userId = $userId;
        $this->date = $date;
    }

}