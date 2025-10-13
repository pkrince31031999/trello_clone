<?php
session_start();

require_once __DIR__ . '/../repositories/MySQLUserRepository.php';
require_once __DIR__ . '/../repositories/MySQLBoardRepository.php';
require_once __DIR__ . '/../repositories/MySQLListRepository.php';
require_once __DIR__ . '/../repositories/MySQLCardRepository.php';
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/BoardService.php';
require_once __DIR__ . '/../services/ListService.php';
require_once __DIR__ . '/../services/CardService.php';

class AdminController {
    private $userService;
    private $boardService;
    private $listService;
    private $cardService;
    
    // Admin credentials (in production, these should be in a secure config file)
    private $adminUsername = 'admin';
    private $adminPassword = 'admin123'; // Change this in production!
    
    public function __construct() {
        $userRepository = new MySQLUserRepository();
        $boardRepository = new MySQLBoardRepository();
        $listRepository = new MySQLListRepository();
        $cardRepository = new MySQLCardRepository();
        
        $this->userService = new UserService($userRepository);
        $this->boardService = new BoardService($boardRepository);
        $this->listService = new ListService($listRepository);
        $this->cardService = new CardService($cardRepository);
    }
    
    public function showLogin() {
        // Check if already logged in as admin
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: index.php?controller=admin&action=dashboard');
            exit();
        }
        
        include __DIR__ . '/../views/admin-login.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Validate admin credentials
            if ($username === $this->adminUsername && $password === $this->adminPassword) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                
                $response = [
                    'success' => true,
                    'message' => 'Login successful'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid username or password'
                ];
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header('Location: index.php?controller=admin&action=showLogin');
        }
    }
    
    public function dashboard() {
        // Check if admin is logged in
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: index.php?controller=admin&action=showLogin');
            exit();
        }
        
        // Get statistics
        $stats = $this->getAdminStats();
        
        include __DIR__ . '/../views/admin-dashboard.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=admin&action=showLogin');
        exit();
    }
    
    public function getStats() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }
        
        $stats = $this->getAdminStats();
        header('Content-Type: application/json');
        echo json_encode($stats);
    }
    
    public function getUsers() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }
        
        try {
            $users = $this->userService->getAllUsers();
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'data' => $users]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    public function getBoards() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }
        
        try {
            $boards = $this->boardService->getAllBoards();
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'data' => $boards]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    public function deleteUser() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['userId'] ?? '';
            
            if (empty($userId)) {
                echo json_encode(['success' => false, 'message' => 'User ID is required']);
                return;
            }
            
            try {
                $result = $this->userService->deleteUser($userId);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    
    public function deleteBoard() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $boardId = $_POST['boardId'] ?? '';
            
            if (empty($boardId)) {
                echo json_encode(['success' => false, 'message' => 'Board ID is required']);
                return;
            }
            
            try {
                $result = $this->boardService->deleteBoard($boardId);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Board deleted successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete board']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    
    private function getAdminStats() {
        try {
            $userCount = $this->userService->getUserCount();
            $boardCount = $this->boardService->getBoardCount();
            $listCount = $this->listService->getListCount();
            $cardCount = $this->cardService->getCardCount();
            
            return [
                'users' => $userCount,
                'boards' => $boardCount,
                'lists' => $listCount,
                'cards' => $cardCount,
                'total_activity' => $userCount + $boardCount + $listCount + $cardCount
            ];
        } catch (Exception $e) {
            return [
                'users' => 0,
                'boards' => 0,
                'lists' => 0,
                'cards' => 0,
                'total_activity' => 0
            ];
        }
    }
}
?>
