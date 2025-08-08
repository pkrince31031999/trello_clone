<?php

session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $boardId = $_POST['boardId'];
    $listName = $_POST['listName'];
    $listDescription = $_POST['listDescription'];

    $getListdata = $conn->prepare("SELECT * FROM lists WHERE board_id = ?");
    $getListdata->bind_param("i", $boardId);
    $getListdata->execute();
    $res = $getListdata->get_result()->fetch_all(MYSQLI_ASSOC);
    if(count($res) < 0){
        $listPosition = 1;
    }else{
        $listPosition = count($res) + 1;
    }

    $stmt = $conn->prepare("INSERT INTO lists(title, board_id,position) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $listName, $boardId, $listPosition);
    $stmt->execute();
    header('Location: board.php?id=' . $boardId);
    exit;
}
?>