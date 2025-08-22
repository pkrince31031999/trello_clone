<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Boards.php';
require_once 'ListRepositoryInterface.php';


class MySQLListRepository implements ListRepositoryInterface
{
    private $conn;

    public function __construct()
    {
        $dbInstance = Database::getInstance();
        $this->conn = $dbInstance->getConnection();
    }

    public function createList($list)
    {
        $listData = $list->toArray();
        $stmt = $this->conn->prepare("INSERT INTO lists (title, board_id, position) VALUES (?, ?, ?)");
        $stmt->execute([$listData['title'], $listData['board_id'], $listData['position']]);
        return $this->conn->lastInsertId();
    }

    public function getListsByBoardId($boardId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM lists WHERE board_id = ?");
         $stmt->execute([$boardId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteList($listId)
    {
        $stmt = $this->conn->prepare("DELETE FROM lists WHERE id = ?");
        return $stmt->execute([$listId]);
    }

    public function updateList(Lists $list)
    {
        $stmt = $this->conn->prepare("UPDATE lists SET name = ? WHERE id = ?");
        return $stmt->execute([$listName, $listId]);
    }

    public function moveList($listId, $boardId)
    {
        $stmt = $this->conn->prepare("UPDATE lists SET board_id = ? WHERE id = ?");
        return $stmt->execute([$boardId, $listId]);
    }

    public function getListById($listId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM lists WHERE id = ?");
        $stmt->execute([$listId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLists()
    {
        $stmt = $this->conn->prepare("SELECT * FROM lists");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getRowCountListsByBoardId($boardId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM lists WHERE board_id = ?");
        $stmt->execute([$boardId]);
        return $stmt->rowCount();
    }


}