<?php
require_once __DIR__ . '/../repositories/MySQLUserRepository.php';
require_once __DIR__ . '/../repositories/MySQLCardRepository.php';
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/CardService.php';

class CommonController{
    private $userService;
    private $cardService;
    public function __construct() {
        $UserRepository     = new MySQLUserRepository();
        $this->userService  = new UserService($UserRepository);
        $CardRepository     = new MySQLCardRepository();
        $this->cardService  = new CardService($CardRepository);
    }

    public function downloadExportTaskSheetCsv(){
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            if(!empty($_POST['user_id']))
            {
                $user_id = $_POST['user_id'];
            }
            
        }
    }

    public function 
}