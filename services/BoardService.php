<?php

require_once __DIR__ . '/../repositories/MySQLBoardRepository.php';

class BoardService {
    private $boardRepo;

    public function __construct(BoardRepositoryInterface $boardRepo) {
        $this->boardRepo = $boardRepo;
    }

    public function getAllBoards() {
        return $this->boardRepo->getAllBoards();
    }

    public function getBoardById($id) {
        return $this->boardRepo->getBoardById($id);
    }

    public function createBoard($data) {
        return $this->boardRepo->createBoard($data);
    }

    public function updateBoard($id, $data) {
        return $this->boardRepo->updateBoard($id, $data);
    }

    public function deleteBoard($id) {
        return $this->boardRepo->deleteBoard($id);
    }

    public function getBoardsByUserId($userId) {
        return $this->boardRepo->getBoardsByUserId($userId);
    }

    public function getBoardByName($name) {
        return $this->boardRepo->getBoardByName($name);
    }

    public function getBoardByDescription($description) {
        return $this->boardRepo->getBoardByDescription($description);
    }

    public function getBoardByCreatedBy($createdBy) {
        return $this->boardRepo->getBoardByCreatedBy($createdBy);
    }
}