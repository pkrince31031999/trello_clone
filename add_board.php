<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}


if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $boardName = strtoupper($_POST['boardName']);
    $boardDescription = $_POST['boardDescription'];
    $userName = $_SESSION['user_id']; // Assuming you have stored the user ID in a session variable named user_name
    $is_archived = 0; 
    // $user_id = $_SESSION['user_id'];
    $alreadyBorad = $conn->prepare("SELECT * FROM boards WHERE name = ?");
    $alreadyBorad->bind_param("s", $boardName);
    $alreadyBorad->execute();
    $res = $alreadyBorad->get_result()->fetch_assoc();
    
    if (empty($res)) {
        $stmtBoard = $conn->prepare("INSERT INTO boards(name, description,created_by,is_archived) VALUES (?, ?, ?, ?)");
        $stmtBoard->bind_param("ssii", $boardName, $boardDescription, $userName, $is_archived);
        $stmtBoard->execute();
        
        $listName = "Assigned";
        $boardId = $stmtBoard->insert_id;
        $stmt = $conn->prepare("INSERT INTO lists(title, board_id) VALUES (?, ?)");
        $stmt->bind_param("si", $listName, $boardId);
        $stmt->execute();
        
        header('Location: dashboard.php');
        exit;
    }else{
        $response['error'] = 'Board with the same name already exists';
        return  json_encode($response);
    }

    $stmt->close();
}