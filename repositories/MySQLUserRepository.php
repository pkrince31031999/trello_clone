<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Users.php';
require_once 'UserRepositoryInterface.php';

class MySQLUserRepository implements UserRepositoryInterface {
    private $conn;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->conn = $dbInstance->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new User($row['id'], $row['name'], $row['email']), $rows);
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new User($row['id'], $row['name'], $row['email']) : null;
    }

    public function create(User $user) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, full_name) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user->name, $user->email, $user->password, $user->fullName]);
    }

    public function update(User $user) {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$user->name, $user->email, $user->id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            return new User($res['id'], $res['username'], $res['email'], $res['password']);
        }
        return null;
    }
}
