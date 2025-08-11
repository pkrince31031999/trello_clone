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

    public function addUser($name, $email) {
        $user = new User($name, $email, $password);
        return $this->userRepo->create($user);
    }

    public function authenticate($email, $password) {
        $user = $this->userRepo->findByEmail($email);
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }
        return null;
    }
}
