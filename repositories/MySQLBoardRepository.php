<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Boards.php';
require_once 'BoardRepositoryInterface.php';

class MySQLBoardRepository implements BoardRepositoryInterface
{
    private $conn;

    public function __construct()
    {
        $dbInstance = Database::getInstance();
        $this->conn = $dbInstance->getConnection();
    }

    public function createBoard(Boards $board)
    {
        $stmt = $this->conn->prepare("INSERT INTO boards (name, description, created_by) VALUES (?, ?, ?)");
        return $stmt->execute([$board->name, $board->description, $board->createdBy]);
    }

    public function updateBoard(Boards $board)
    {
        $stmt = $this->conn->prepare("UPDATE boards SET name = ?, description = ? WHERE id = ?");
        return $stmt->execute([$board->name, $board->description, $board->id]);
    }

    public function deleteBoard($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM boards WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllBoards()
    {
        $stmt = $this->conn->prepare("SELECT * FROM boards");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBoardById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM boards WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getBoardsByUserId($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM boards WHERE created_by = ?");
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }

    public function getBoardByName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM boards WHERE name = ?");
        $stmt->execute([$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getBoardByDescription($description)
    {
        $stmt = $this->conn->prepare("SELECT * FROM boards WHERE description = ?");
        $stmt->execute([$description]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getBoardByCreatedBy($createdBy)
    {
        $stmt = $this->conn->prepare("SELECT * FROM boards WHERE created_by = ?");
        $stmt->execute([$createdBy]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function getBoardMembers($boardId){
        $stmt = $this->conn->prepare("Select U.id as user_id, U.username,BM.id as board_member_id,BM.board_id from board_members as BM inner join users as U on BM.user_id = U.id where board_id = ?");
        $stmt->execute([$boardId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // public function getBoardByNameAndDescription($name, $description)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM boards WHERE name = ? AND description = ?");
    //     $stmt->execute([$name, $description]);
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $row;
    // }

    // public function getBoardByNameAndCreatedBy($name, $createdBy)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM boards WHERE name = ? AND created_by = ?");
    //     $stmt->execute([$name, $createdBy]);
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $row;
    // }

    // public function getBoardByDescriptionAndCreatedBy($description, $createdBy)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM boards WHERE description = ? AND created_by = ?");
    //     $stmt->execute([$description, $createdBy]);
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $row;
    // }

    // public function getBoardByNameAndDescriptionAndCreatedBy($name, $description, $createdBy)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM boards WHERE name = ? AND description = ? AND created_by = ?");
    //     $stmt->execute([$name, $description, $createdBy]);
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $row;
    // }
}
