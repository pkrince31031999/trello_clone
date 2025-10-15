<?php
 interface CardRepositoryInterface {
     public function getAllCards();
     public function getCardById($id);
     public function createCard(Card $cardData);
     public function updateCard(Card $cardData, $id);
     public function deleteCard(Card $id);
     public function moveCard($id, $listId);
     public function archiveCard($id);
     public function unarchiveCard($id);
     public function getCardsByListId($listId);
     public function getCardsByBoardId($boardId);
     public function getCardsByListIdAndBoardId($listId, $boardId);
     public function getArchivedCardsByBoardId($boardId);
     public function getArchivedCardsByListId($listId);
     public function getArchivedCardsByListIdAndBoardId($listId, $boardId);
     public function getUnarchivedCardsByBoardId($boardId);
     public function getUnarchivedCardsByListId($listId);
     public function getUnarchivedCardsByListIdAndBoardId($listId, $boardId);
     public function getUnarchivedCardsByBoardIdAndListId($boardId, $listId);
     public function getArchivedCardsByBoardIdAndListId($boardId, $listId);
     public function updateCardPositions($soureListId, $targetListId, $sourceCardIds, $targetCardIds);
 }