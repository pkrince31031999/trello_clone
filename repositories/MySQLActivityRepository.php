<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Activity.php';
require_once 'ActivityRepositoryInterface.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class MySQLActivityRepository implements ActivityRepositoryInterface
{
    private $conn;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->conn = $dbInstance->getConnection();
    }
    public function createActivity($activityData) {
        $stmt = $this->conn->prepare('INSERT INTO activities (user_id, card_id, board_id, message, action, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$activityData['user_id'], $activityData['card_id'], $activityData['board_id'], $activityData['message'], $activityData['action']]);
        return $this->conn->lastInsertId();
    }

    public function getActivityByCardId() {
        $stmt = $this->conn->prepare('SELECT ac.*,u.username,u.email FROM activities as ac LEFT JOIN users as u ON ac.user_id = u.id WHERE ac.card_id = ? ORDER BY ac.created_at DESC');
        $stmt->execute([$_GET['cardid']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}