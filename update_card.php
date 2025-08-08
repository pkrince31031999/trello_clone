<?php

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
    $updateQuery = $conn->prepare("UPDATE cards SET list_id = ?, position = ? WHERE id = ?");
    
    foreach ($_POST['sourceCardIds'] as $sourceCard) {
        $updateQuery->bind_param("iii", $_POST['sourceListId'], $sourceCard['position'], $sourceCard['cardId']);
        $updateQuery->execute();
    }

    foreach ($_POST['targetCardIds'] as $targetCard) {
        $updateQuery->bind_param("iii", $_POST['targetListId'], $targetCard['position'], $targetCard['cardId']);
        $updateQuery->execute();
    }

    echo json_encode(['success' => true]);
}
?>