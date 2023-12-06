<?php
require_once("db.php");

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];

// 해당 제목을 가진 포스트를 삭제하는 쿼리
$query = "DELETE FROM tbl_post WHERE post_name = ?";
$result = db_update_delete($query, array($title));

header('Content-Type: application/json');
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}
?>  