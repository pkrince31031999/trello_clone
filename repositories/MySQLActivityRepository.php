<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Activity.php';
require_once 'ActivityRepositoryInterface.php';

class MySQLActivityRepository implements ActivityRepositoryInterface
{
    private $conn;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->conn = $dbInstance->getConnection();
    }
    public function createActivity($activityData) {
        $stmt = $this->conn->prepare('INSERT INTO activities (user_id, card_id, description, created_at) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$activityData['user_id'], $activityData['card_id'], $activityData['description']]);
    }

    public function getActivityByCardId() {
        $stmt = $this->conn->prepare('SELECT * FROM activities WHERE card_id = ? ORDER BY created_at DESC');
        $stmt->execute([$_GET['cardid']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}