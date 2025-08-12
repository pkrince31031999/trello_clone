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

class BoardController {
    private $boardService;
    private $userService;
    private $listService;
    private $cardService;
    public function __construct() {
        $BoardRepository = new MySQLBoardRepository();
        $this->boardService = new BoardService($BoardRepository);
        $UserRepository = new MySQLUserRepository();
        $this->userService = new UserService($UserRepository);
        $ListRepository = new MySQLListRepository();
        $this->listService = new ListService($ListRepository);
        $CardRepository = new MySQLCardRepository();
        $this->cardService = new CardService($CardRepository);
    }
    public function showDashboard() {
        // Fetch necessary data
        $userId = $_SESSION['user_id'];
        $boards = $this->boardService->getBoardsByUserId($userId);
        $userdata = $this->userService->findById($userId);
    
        if(!empty($boards && !empty($userdata))){
            $response = array('boardData' => $boards, 'userdata' => $userdata->toArray());
            // Pass data to view
            require_once __DIR__ . '/../views/dashboard.php';
        }

        // Pass data to view
        
    }

    public function showCreateBoard() {
        include __DIR__ . '/../views/create-board.php'; // Loads create board UI
    }

    public function showBoard() {

        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cardData = [];
            $boardId  = $_GET['id'];
            $userData = $this->userService->findById($_SESSION['user_id']);
            $listData    = $this->listService->getListsByBoardId($boardId);
            foreach ($listData as $key => $value) {
             $listData[$key]['cards']  = $this->cardService->getCardsByListId($value['id']);
            }

            $response = array('boardId' => $boardId, 'listData' => $listData,'userdata' => $userData->toArray());  
        }
        include __DIR__ . '/../views/board.php'; // Loads board UI
    }

    public function createBoard() {
       if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $boardName = $_POST['boardName'];
            $boardDescription = $_POST['boardDescription'];
            $userId = $_SESSION['user_id'];
            $data = array('name' => $boardName, 'description' => $boardDescription, 'created_by' => $userId);
            $isBoardCreated = $this->boardService->createBoard($data);
            if($isBoardCreated) {
                $response = json_encode(array('success' => true, 'message' => "Board " .$boardName." created successfully."));   
            }else{
                $response = json_encode(array('success' => false, 'message' => 'Failed to create board.'));
            }
            echo $response; exit;
       }
    }
}