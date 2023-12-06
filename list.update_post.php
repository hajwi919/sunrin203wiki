<?php
require_once("db.php");

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];
$content = $data['content'];

// 해당 제목을 가진 포스트를 업데이트하는 쿼리
$query = "UPDATE tbl_post SET post_content = ? WHERE post_name = ?";
$result = db_update_delete($query, array($content, $title));

header('Content-Type: application/json');
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}
?>
