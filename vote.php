<?php
include 'connection.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$type = $data['type'];

if($type == 'helpful'){
    $conn->query("UPDATE feedback SET helpful = helpful + 1 WHERE id = $id");
}else{
    $conn->query("UPDATE feedback SET not_helpful = not_helpful + 1 WHERE id = $id");
}

echo json_encode(['success'=>true]);
?>
