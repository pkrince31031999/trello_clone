<?php

require_once __DIR__ . '/../repositories/MySQLCardRepository.php';

class CardService {
    private $cardRepository;

    public function __construct($cardRepository) {
        $this->cardRepository = $cardRepository;
    }

    public function createCard(Card $cardData) {
        return $this->cardRepository->createCard($cardData);
    }

    public function updateCard($cardData , $cardId) {
        return $this->cardRepository->updateCard($cardId, $cardData);
    }
    
    public function deleteCard($cardId) {
        return $this->cardRepository->deleteCard($cardId);
    }

    public function getAllCards() {
        return $this->cardRepository->getAllCards();
    }

    public function getCardById($cardId) {
        return $this->cardRepository->getCardById($cardId);
    }

    public function getCardsByListId($listId) {
        return $this->cardRepository->getCardsByListId($listId);
    }

    public function moveCard($cardId, $listId) {
        return $this->cardRepository->moveCard($cardId, $listId);
    }

    public function archiveCard($cardId) {
        return $this->cardRepository->archiveCard($cardId);
    }

    public function unarchiveCard($cardId) {
        return $this->cardRepository->unarchiveCard($cardId);
    }

    public function getCardsByBoardId($boardId) {
        return $this->cardRepository->getCardsByBoardId($boardId);
    }

    public function getCardsByListIdAndBoardId($listId, $boardId) {
        return $this->cardRepository->getCardsByListIdAndBoardId($listId, $boardId);
    }

    public function getArchivedCardsByBoardId($boardId) {
        return $this->cardRepository->getArchivedCardsByBoardId($boardId);
    }

    public function getArchivedCardsByListId($listId) {
        return $this->cardRepository->getArchivedCardsByListId($listId);
    }

    public function getArchivedCardsByListIdAndBoardId($listId, $boardId) {
        return $this->cardRepository->getArchivedCardsByListIdAndBoardId($listId, $boardId);
    }

    public function getUnarchivedCardsByBoardId($boardId) {
        return $this->cardRepository->getUnarchivedCardsByBoardId($boardId);
    }

    public function getUnarchivedCardsByListId($listId) {
        return $this->cardRepository->getUnarchivedCardsByListId($listId);
    }

    public function getUnarchivedCardsByListIdAndBoardId($listId, $boardId) {
        return $this->cardRepository->getUnarchivedCardsByListIdAndBoardId($listId, $boardId);
    }

    public function getUnarchivedCardsByBoardIdAndListId($boardId, $listId) {
        return $this->cardRepository->getUnarchivedCardsByBoardIdAndListId($boardId, $listId);
    }

    public function getArchivedCardsByBoardIdAndListId($boardId, $listId) {
        return $this->cardRepository->getArchivedCardsByBoardIdAndListId($boardId, $listId);
    }

    public function updateCardPositions($soureListId, $targetListId, $sourceCardIds, $targetCardIds) {
        return $this->cardRepository->updateCardPositions($soureListId, $targetListId, $sourceCardIds, $targetCardIds);
    }

}