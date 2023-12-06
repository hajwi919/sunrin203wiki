<?php
// 로그인 체크
session_start();
if (isset($_SESSION['member_id']) === false){
    header("Location: /");
    exit();
}

// DB Require
require_once("inc/db.php");

$member_id = $_SESSION['member_id'];
$post_query = "select post_id, post_content from tbl_post where member_id = ? order by insert_date desc limit 10";
$post_data = db_select($post_query, array($member_id));

$last_post_id = count($post_data) > 0 ? $post_data[count($post_data) - 1]['post_id'] : "0";

function get_topics() {
    $query = "SELECT * FROM tbl_post ORDER BY post_id DESC";
    return db_select($query);
}

$topics = get_topics();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>203 위키</title>
    <style>
        #content {
            max-width: 800px;
            margin: 10px auto; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba
        }
        h1 {
            color: #333;
        }
        #topic-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        #topic-list li {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #topic-list li:hover {
            background-color: #ddd;
        }
        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php require_once("inc/header.php"); ?>
    <div id="content">
        <h1>203 위키</h1>
        <ul id="topic-list">
            <?php foreach($topics as $topic): ?>
                <li onclick="redirectToTopicPage('<?= $topic['post_name'] ?>')"><?= $topic['post_name'] ?></li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <button onclick="createNewTopic()">새로 만들기</button>
    </div>

    <script>
        function redirectToTopicPage(title) {
            window.location.href = `list.topic_page.php?title=${encodeURIComponent(title)}`;
        }

        function createNewTopic() {
            var newPostTitle = prompt("새로운 글 제목을 입력하세요:");
            if (newPostTitle && newPostTitle.trim() !== "") {
                window.location.href = `list.create.php?post_name=${encodeURIComponent(newPostTitle)}`;
            } else {
                alert("글 제목을 입력해주세요.");
            }
        }
    </script>
</body>
</html>
