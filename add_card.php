<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $boardId = $_POST['boardId'];
    $listId = $_POST['listId'];
    $taskTitle = $_POST['title'];
    $isArchived = 0;

    $getListdata = $conn->prepare("SELECT * FROM cards WHERE list_id = ?");
    $getListdata->bind_param("i", $listId);
    $getListdata->execute();
    $res = $getListdata->get_result()->fetch_all(MYSQLI_ASSOC);
    if(count($res) < 0){
        $listPosition = 1;
    }else{
        $listPosition = count($res) + 1;
    }
    
    $stmt = $conn->prepare("INSERT INTO cards(title,list_id, is_archived, position) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $taskTitle,$listId,$isArchived,$listPosition);
    $stmt->execute();
    header('Location: board.php?id=' . $boardId);
    exit;
}

?>