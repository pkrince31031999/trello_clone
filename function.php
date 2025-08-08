<?php 
 session_start();
 include 'db.php';

$data = $_REQUEST;
$tab = $data['tab'];
switch ($tab) {
    case 'card-date-update':
           $startDate               = $data['startDate'];
           $endDate                 = $data['endDate'];
           $cardId                  = $data['cardId'];
           $updateDueDateQuery      = $conn->prepare("UPDATE cards SET start_date = ?, end_date = ? WHERE id = ?");
           $stmt->bind_param("ssi", $startDate, $endDate, $cardId);
           $stmt->execute();
        
        break;
    default:
        # code...
        break;
}
?>