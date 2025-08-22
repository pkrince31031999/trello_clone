<?php
session_start();

require_once __DIR__ . '/../repositories/MySQLBoardRepository.php';
require_once __DIR__ . '/../repositories/MySQLUserRepository.php';
require_once __DIR__ . '/../repositories/MySQLListRepository.php';
require_once __DIR__ . '/../repositories/MySQLCardRepository.php';
require_once __DIR__ . '/../services/BoardService.php';
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/ListService.php';
require_once __DIR__ . '/../services/CardService.php';
require_once __DIR__ . '/../models/Lists.php';

class ListController {
    private $listService;
    public function __construct() {
        $ListRepository = new MySQLListRepository();
        $this->listService = new ListService($ListRepository);
    }

    public function getAllLists() {
        return $this->listService->getAllLists();
    }

    public function getListById($id) {
        return $this->listService->getListById($id);
    }

    public function createList() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $list = new Lists();
            $list->setTitle($_POST['listName']);
            $list->setBoardId($_POST['boardId']);
            $listCount = $this->listService->getRowCountListsByBoardId($_POST['boardId']);
            $list->setPosition($listCount + 1);
            $isListCreated = $this->listService->createList($list);
            if($isListCreated) {
                 $response = json_encode(array('success' => true, 'message' => "List created successfully."));   
            }else{
                 $response = json_encode(array('success' => false, 'message' => 'Failed to create list.'));
            }
            echo $response;
        }
    }

    public function updateList($id, $data) {
        return $this->listService->updateList($id, $data);
    }

    public function deleteList($id) {
        return $this->listService->deleteList($id);
    }
}