<?php

interface BoardRepositoryInterface {
    public function getAllBoards();
    public function getBoardById($id);
    public function createBoard(Boards $board);
    public function updateBoard(Boards $board);
    public function deleteBoard($id);
    public function getBoardsByUserId($userId);
    
}