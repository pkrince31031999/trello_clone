<?php
session_start();
require_once __DIR__ . '/../repositories/MySQLUserRepository.php';
require_once __DIR__ . '/../services/UserService.php';



    
class UserController {
    private $userService;

    public function __construct() {
        $userRepository = new MySQLUserRepository();
        $this->userService = new UserService($userRepository); // pass dependency
    }
    public function showLogin()
    {
        include __DIR__ . '/../views/login.php';// Loads login UI
    }
    
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $pass  = $_POST['password'];

            $user = $this->userService->authenticate($email, $pass);
            
            header('Content-Type: application/json');

            if ($user) {
                $_SESSION['user_id']   = $user->getId();
                $_SESSION['user_name'] = $user->getUsername();
                $response = json_encode([
                    'success' => true,
                    'message' => 'Login successful. Redirecting to dashboard.'
                ]);
            } else {
                $response = json_encode([
                    'success' => false,
                    'error' => 'Invalid login.'
                ]);
            }
            echo $response; exit; // stop PHP execution after sending JSON
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }


    public function showRegister()
    {
        include __DIR__ . '/../views/register.php';// Loads register UI
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $isUserCreated = $this->userService->addUser($name, $email, $pass);
            if ($isUserCreated) {
                $response = json_encode([
                    'success' => true,
                    'message' => 'User created successfully. Redirecting to login page.'
                ]);
            } else {
                $response = json_encode([
                    'success' => false,
                    'message' => 'User creation failed. Please try again.'
                ]);
            }
            
            header('Content-Type: application/json');
            echo $response; exit;
            
        }
    }

}

