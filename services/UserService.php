<?php
require_once __DIR__ . '/../repositories/MySQLUserRepository.php';

class UserService {
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function listUsers() {
        return $this->userRepo->getAll();
    }

    public function addUser($name, $email, $password) {
    
        $user = new User($id=null,$name, $email, $password);
        return $this->userRepo->create($user);
    }

    public function authenticate($email, $password) {
        $user = $this->userRepo->findByEmail($email);
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }
        return null;
    }

    public function findById($id) {
        return $this->userRepo->findById($id);
    }

    public function sendPasswordResetLink($email) {
        $user = $this->userRepo->findByEmail($email);
        if ($user) {
            $token = bin2hex(random_bytes(16)); // Generate a random token
            $this->userRepo->savePasswordResetToken($email, $token); // Save token in the database

            $resetLink = "https://yourdomain.com/reset_password.php?token=$token";
            // Assuming sendEmail is a function that sends an email
            sendEmail($email, "Password Reset Request", "Click this link to reset your password: $resetLink");
            
            return true;
        }
        return false;
    }

    public function resetPassword($token, $password) {
        $user = $this->userRepo->findByPasswordResetToken($token);
        if ($user) {
            $user->setPassword($password);
            $this->userRepo->update($user);
            return true;
        }
        return false;
    }

    public function getUserDetailsByIds($userId) {
        return $this->userRepo->getUserDetailsByIds($userId);
    }
}
