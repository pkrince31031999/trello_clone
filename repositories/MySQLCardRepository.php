<?php

require_once __DIR__ . '/../repositories/MySQLCardRepository.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Cards.php';
require_once 'CardRepositoryInterface.php';

class MySQLCardRepository implements CardRepositoryInterface
{
    private $conn;

    public function __construct()
    {
        $dbInstance = Database::getInstance();
        $this->conn = $dbInstance->getConnection();
    }

    public function getAllCards()
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCardsByListId($listId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE list_id = ?");
        $stmt->execute([$listId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCardById($cardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE id = ?");
        $stmt->execute([$cardId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCard($cardData)
    {
        $cardData = $cardData->toArray();
        $stmt = $this->conn->prepare("INSERT INTO cards (title, description, list_id) VALUES (?, ?, ?)");
        $stmt->execute([$cardData['title'], $cardData['description'], $cardData['list_id']]);
        return $this->conn->lastInsertId();
    }

    public function updateCard(Card $cardData, $cardId)
    {
        $stmt = $this->conn->prepare("UPDATE cards SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$cardData['title'], $cardData['description'], $cardId]);
        return $stmt->rowCount();
    }

    public function deleteCard($cardId)
    {
        $stmt = $this->conn->prepare("DELETE FROM cards WHERE id = ?");
        $stmt->execute([$cardId]);
        return $stmt->rowCount();
    }

    public function moveCard($cardId, $listId)
    {
        $stmt = $this->conn->prepare("UPDATE cards SET list_id = ? WHERE id = ?");
        $stmt->execute([$listId, $cardId]);
        return $stmt->rowCount();
    }

    public function getCardsByBoardId($boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCardsByListIdAndBoardId($listId, $boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE list_id = ? AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$listId, $boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCardDate($cardId, $startDate, $endDate)
    {
        $stmt = $this->conn->prepare("UPDATE cards SET start_date = ?, end_date = ? WHERE id = ?");
        $stmt->execute([$startDate, $endDate, $cardId]);
        return $stmt->rowCount();
    }
    public function archiveCard($cardId)
    {
        $stmt = $this->conn->prepare("UPDATE cards SET is_archived = 1 WHERE id = ?");
        $stmt->execute([$cardId]);
        return $stmt->rowCount();
    }

    public function unarchiveCard($cardId)
    {
        $stmt = $this->conn->prepare("UPDATE cards SET is_archived = 0 WHERE id = ?");
        $stmt->execute([$cardId]);
        return $stmt->rowCount();
    }

    public function getArchivedCardsByBoardId($boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 1 AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArchivedCardsByListId($listId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 1 AND list_id = ?");
        $stmt->execute([$listId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArchivedCardsByListIdAndBoardId($listId, $boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 1 AND list_id = ? AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$listId, $boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnarchivedCardsByBoardId($boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 0 AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnarchivedCardsByListId($listId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 0 AND list_id = ?");
        $stmt->execute([$listId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnarchivedCardsByListIdAndBoardId($listId, $boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 0 AND list_id = ? AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$listId, $boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnarchivedCardsByBoardIdAndListId($boardId, $listId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 0 AND list_id = ? AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$listId, $boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArchivedCardsByBoardIdAndListId($boardId, $listId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cards WHERE is_archived = 1 AND list_id = ? AND list_id IN (SELECT id FROM lists WHERE board_id = ?)");
        $stmt->execute([$listId, $boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCardPositions($soureListId, $targetListId, $sourceCardIds, $targetCardIds)
    {
        $stmt = $this->conn->prepare("UPDATE cards SET list_id = ? , position = ? WHERE id = ?");
        if(isset($sourceCardIds) && !empty($sourceCardIds)){
                foreach ($sourceCardIds as $sourceCard) {
                $stmt->execute([$soureListId, $sourceCard['position'], $sourceCard['cardId']]);
            }
        }
        
        if(isset($targetCardIds) && !empty($targetCardIds))
        {
            foreach ($targetCardIds as $targetCard) {
                $stmt->execute([$targetListId, $targetCard['position'], $targetCard['cardId']]);
            }
        }
        return $stmt->rowCount();
    }
}