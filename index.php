<?php
ini_set('display_errors', 1);         // Show errors
ini_set('display_startup_errors', 1); // Show startup errors
error_reporting(E_ALL);  


$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action     = isset($_GET['action']) ? $_GET['action'] : 'showLogin';

// Build file path
$controllerFile = __DIR__ . "/controllers/" . ucfirst($controller) . "Controller.php";

// Check if file exists before requiring
if (!file_exists($controllerFile)) {
    die("Controller file not found: " . $controllerFile);
}

require_once $controllerFile;

$controllerClass = ucfirst($controller) . "Controller";

// Check if class exists
if (!class_exists($controllerClass)) {
    die("Controller class $controllerClass not found.");
}

$ctrl = new $controllerClass();

// Check if method exists
if (!method_exists($ctrl, $action)) {
    die("Method $action not found in $controllerClass");
}

$ctrl->$action();
