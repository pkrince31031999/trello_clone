<?php

interface BoardRepositoryInterface {
    public function getAllBoards();
    public function getBoardById($id);
    public function createBoard($data);
    public function updateBoard($id, $data);
    public function deleteBoard($id);
}