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

if (isset($_GET['cardid'])  && !empty($_GET['cardid']) || isset($_GET['boardId']) && !empty($_GET['boardId'])) {
    $cardId = $_GET['cardid'];
    $stmt = $conn->prepare("SELECT * FROM cards WHERE id = ?");
    $stmt->bind_param("i", $cardId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $listDetails = $conn->prepare("SELECT * FROM lists WHERE id = ?");
    $listDetails->bind_param("i", $result['list_id']);
    $listDetails->execute();
    $result['listDetails'] = $listDetails->get_result()->fetch_assoc();
    
    $activity = $conn->prepare("SELECT * FROM activities WHERE card_id = ?");
    $activity->bind_param("i", $cardId);
    $activity->execute();
    $result['comments'] = $activity->get_result()->fetch_all(MYSQLI_ASSOC);

    $cardAssignees = $conn->prepare("SELECT assigned_users FROM cards where id = ?");
    $cardAssignees->bind_param("i", $cardId);
    $cardAssignees->execute();
    $res['assignees_id'] = $cardAssignees->get_result()->fetch_all(MYSQLI_ASSOC);

    $user_ids_str = $res['assignees_id'][0]['assigned_users']; 
    $user_ids_raw = explode(',', $user_ids_str);
    $user_ids = array_map(function($id) {
        return trim($id, " \t\n\r\0\x0B'\""); // removes spaces, quotes, newlines
    }, $user_ids_raw);
    $placeholders = implode(',', array_fill(0, count($user_ids), '?'));
    $sql = "SELECT id, username FROM users WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $types = str_repeat('i', count($user_ids));
    $stmt->bind_param($types, ...$user_ids);
    $stmt->execute();
    $res_assignees = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $result['assignees'] = $res_assignees;

    $boardMembers = $conn->prepare("Select U.id as user_id, U.username,BM.id as board_member_id,BM.board_id from board_members as BM inner join users as U on BM.user_id = U.id where board_id = ?");
    $boardMembers->bind_param("i", $_GET['boardId']);
    $boardMembers->execute();
    $result['boardMembers'] = $boardMembers->get_result()->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);
}
?>