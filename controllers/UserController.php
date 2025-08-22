<?php
session_start();
require_once __DIR__ . '/../repositories/MySQLUserRepository.php';
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../models/Users.php';
require_once __DIR__ . '/../services/ListService.php';



    
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
                    'error' => 'Invalid email or password.'
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
                    'error' => 'User creation failed. Please try again.'
                ]);
            }
            
            header('Content-Type: application/json');
            echo $response; exit;
            
        }
    }

    public function showForgotPassword()
    {
        include __DIR__ . '/../views/forgot-password.php';// Loads forgot password UI
    }

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $this->userService->sendPasswordResetLink($email);
            $response = json_encode([
                'success' => true,
                'message' => 'Password reset link sent. Please check your email.'
            ]);
            header('Content-Type: application/json');
            echo $response; exit;
        }
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $this->userService->resetPassword($token, $password);
            $response = json_encode([
                'success' => true,
                'message' => 'Password reset successful. Redirecting to login page.'
            ]);
            header('Content-Type: application/json');
            echo $response; exit;
        }
    }

}

