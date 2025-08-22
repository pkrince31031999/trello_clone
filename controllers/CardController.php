<?php

session_start();

require_once __DIR__ . '/../repositories/MySQLBoardRepository.php';
require_once __DIR__ . '/../repositories/MySQLUserRepository.php';
require_once __DIR__ . '/../repositories/MySQLListRepository.php';
require_once __DIR__ . '/../repositories/MySQLCardRepository.php';
require_once __DIR__ . '/../repositories/MySQLActivityRepository.php';
require_once __DIR__ . '/../services/BoardService.php';
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/ListService.php';
require_once __DIR__ . '/../services/CardService.php';
require_once __DIR__ . '/../services/ActivityService.php';

class CardController {
    private $cardService;
    private $listService;
    private $activityService;
    private $userService;
    private $boardService;
    public function __construct() {
        $CardRepository     = new MySQLCardRepository();
        $this->cardService  = new CardService($CardRepository);
        $listRepository     = new MySQLListRepository();
        $this->listService  = new ListService($listRepository);
        $activityRepository = new MySQLActivityRepository();
        $this->activityService = new ActivityService($activityRepository);
        $userRepository     = new MySQLUserRepository();
        $this->userService  = new UserService($userRepository);
        $boardRepository    = new MySQLBoardRepository();
        $this->boardService = new BoardService($boardRepository);
    }

    public function getAllCards() {
        return $this->cardService->getAllCards();
    }

    public function getCardById() {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cardId = $_GET['cardid'];
            $responseData = [];
            $cardDetail = $this->cardService->getCardById($cardId);
            if($cardDetail && isset($cardDetail['list_id']) && !empty($cardDetail['list_id'])) {
                $responseData = $cardDetail;
                $user_ids_str = $cardDetail['assigned_users']; 
                $user_ids_raw = explode(',', $user_ids_str);
                $user_ids = array_map(function($id) {
                    return trim($id, " \t\n\r\0\x0B'\""); // removes spaces, quotes, newlines
                }, $user_ids_raw);
                $placeholders = implode(',', array_fill(0, count($user_ids), '?'));
                $data['placeholders'] = $placeholders;
                $data['user_ids'] = $user_ids;
                $assigneeCard = $this->userService->getUserDetailsByIds($data);
                if($assigneeCard) {
                    $responseData['assignees'] = $assigneeCard;
                }
                $listDetail = $this->listService->getListById($cardDetail['list_id']);
                if($listDetail){
                    $responseData['listDetails'] = $listDetail[0];
                }
            }
            
            $activityDetail = $this->activityService->getActivityByCardId($cardId);
            if($activityDetail) {
                $responseData['comments'] = $activityDetail;   
            }

            $boardMembers = $this->boardService->getBoardMembers($_GET['boardId']);
            if($boardMembers) {
                $responseData['boardMembers'] = $boardMembers;
            }
            echo json_encode($responseData);
        }
       
    }

    public function createCard() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $card = new Card();
            $card->setTitle($_POST['title'] ?? '');
            $card->setDescription($_POST['description'] ?? '');
            $card->setListId($_POST['listId'] ?? 0);
            $card->setCreatedBy($_SESSION['user_id'] ?? 0);
            $isCardCreated = $this->cardService->createCard($card);
            print_r($isCardCreated);
            if($isCardCreated) {
                    $cardId = $isCardCreated;
                    $activityDescription = $_SESSION['user_name'] ." created a card ";
                    $isActivityCreated   = $this->activityService->createActivity($cardId, $_SESSION['user_id'], 'card', 'created');
                    print_r($isActivityCreated);die;
                    if($isActivityCreated) {
                        $response = array('success' => true, 'message' => 'Card created successfully.');
                    }
                    
            }else{
                    $response = array('success' => false, 'message' => 'Failed to create card.');
            }
            echo json_encode($response);
        }
         
    }

    public function updateCard($cardData, $cardId) {
        return $this->cardService->updateCard($cardData, $cardId);
    }

    public function deleteCard($cardId) {
        return $this->cardService->deleteCard($cardId);
    }

    public function updateCardPositions() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $soureListId   = isset($_POST['sourceListId'])  && !empty($_POST['sourceListId'])  ? $_POST['sourceListId']  : 0;
            $targetListId  = isset($_POST['targetListId'])  && !empty($_POST['targetListId'])  ? $_POST['targetListId']  : 0;
            $sourceCardIds = isset($_POST['sourceCardIds']) && !empty($_POST['sourceCardIds']) ? $_POST['sourceCardIds'] : [];
            $targetCardIds = isset($_POST['targetCardIds']) && !empty($_POST['targetCardIds']) ? $_POST['targetCardIds'] : [];
            $movedCardIds  = isset($_POST['movedCardIds'])  && !empty($_POST['movedCardIds'])  ? $_POST['movedCardIds']  : [];
            $responseUpdateCardPositions = $this->cardService->updateCardPositions($soureListId, $targetListId, $sourceCardIds, $targetCardIds);
            if($responseUpdateCardPositions) {
                $source = $this->listService->getListById($soureListId);
                $target = $this->listService->getListById($targetListId);
                $listName = $source[0]['name'] . ' to ' . $target[0]['name'];
                $activityDescription = $_SESSION['user_name'] ." moved a card from" . $listName;
                $this->activityService->createActivity($_SESSION['user_id'],$movedCardIds,$activityDescription,'');
                $response = json_encode(array('success' => true, 'message' => "Card positions updated successfully."));   
            }else{
                $response = json_encode(array('success' => false, 'message' => 'Failed to update card positions.'));
            }
            echo $response;

        }
    }

    public function updateCardDate() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cardId    = $_POST['cardId'];
            $startDate = isset($_POST['startDate']) && !empty($_POST['startDate']) ? $_POST['startDate'] : NULL;
            $endDate   = isset($_POST['endDate'])   && !empty($_POST['endDate'])   ? $_POST['endDate']   : NULL;

            $updateDate = $this->cardService->updateCardDate($cardId, $startDate, $endDate);
            if($updateDate) {
                $response = json_encode(array('success' => true, 'message' => "Card date updated successfully."));   
            }else{
                $response = json_encode(array('success' => false, 'message' => 'Failed to update card date.'));
            }
            echo $response;
        }
       
    }
}