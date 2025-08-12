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

class CardController {
    private $cardService;
    public function __construct() {
        $CardRepository = new MySQLCardRepository();
        $this->cardService = new CardService($CardRepository);
    }

    public function getAllCards() {
        return $this->cardService->getAllCards();
    }

    public function getCardById() {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cardId = $_GET['cardid'];
            $cardDetail = $this->cardService->getCardById($cardId);
            $listDetail = $this->listService->getListById($cardDetail['list_id']);
            if($cardDetail) {
                
            }

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
            if($isCardCreated) {
                    $response = array('success' => true, 'message' => 'Card created successfully.');
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
            $soureListId   = isset($_POST['sourceListId']) && !empty($_POST['sourceListId']) ? $_POST['sourceListId'] : 0;
            $targetListId  = isset($_POST['targetListId']) && !empty($_POST['targetListId']) ? $_POST['targetListId'] : 0;
            $sourceCardIds = isset($_POST['sourceCardIds']) && !empty($_POST['sourceCardIds']) ? $_POST['sourceCardIds'] : [];
            $targetCardIds = isset($_POST['targetCardIds']) && !empty($_POST['targetCardIds']) ? $_POST['targetCardIds'] : [];
            $responseUpdateCardPositions = $this->cardService->updateCardPositions($soureListId, $targetListId, $sourceCardIds, $targetCardIds);
            if($responseUpdateCardPositions) {
                $response = json_encode(array('success' => true, 'message' => "Card positions updated successfully."));   
            }else{
                $response = json_encode(array('success' => false, 'message' => 'Failed to update card positions.'));
            }
            echo $response;

        }
    }
}