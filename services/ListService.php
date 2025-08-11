<?php

require_once __DIR__ . '/../repositories/MySQLListRepository.php';

class ListService {
    public function __construct(ListRepositoryInterface $listRepo) {
        $this->listRepo = $listRepo;
    }

    public function getAllLists() {
        return $this->listRepo->getAllLists();
    }

    public function getListById($id) {
        return $this->listRepo->getListById($id);
    }

    public function createList($data) {
        return $this->listRepo->createList($data);
    }

    public function updateList($id, $data) {
        return $this->listRepo->updateList($id, $data);
    }

    public function deleteList($id) {
        return $this->listRepo->deleteList($id);
    }

    public function getListsByBoardId($boardId) {
        return $this->listRepo->getListsByBoardId($boardId);
    }
        
}
