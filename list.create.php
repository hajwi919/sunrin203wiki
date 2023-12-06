<?php
session_start();

require_once("inc/db.php");

if(isset($_GET['post_name']) && !empty($_GET['post_name'])) {
    $title = $_GET['post_name'];
    $content = ""; // 새로운 주제의 내용은 비어있는 상태
    $member_id = $_SESSION['member_id']; // 로그인한 사용자의 member_id

    $query = "INSERT INTO tbl_post (post_name, post_content, member_id) VALUES (?, ?, ?)";
    $param = array($title, $content, $member_id);

    $result = db_insert($query, $param);

    if($result) {
        // 새로운 주제 생성 성공
        header("Location: list.php?title=".urlencode($title));
    } else {
        // 새로운 주제 생성 실패
        echo "주제 생성에 실패했습니다.";
    }
} else {
    echo "유효하지 않은 접근입니다.";
}
?>
