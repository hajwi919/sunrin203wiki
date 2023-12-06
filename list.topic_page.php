<?php
// 로그인 체크
session_start();
if (isset($_SESSION['member_id']) === false){
    header("Location: /");
    exit();
}

// DB Require
require_once("inc/db.php");

// 제목을 URL로부터 가져옴
$title = $_GET['title'];

// 해당 제목을 가진 포스트를 찾는 쿼리
$post_query = "SELECT * FROM tbl_post WHERE post_name = ?";
$post_data = db_select($post_query, array($title));

if ($post_data) {
    $post_data = $post_data[0]; // 첫 번째 결과를 가져옴
} else {
    // 해당 제목의 포스트가 없으면 메인 페이지로 리다이렉트
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f8f8f8;
            color: #333;
        }

        #content {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007BFF;
        }

        h2 {
            color: #6C757D;
        }

        .editable-content {
            border: 1px;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            min-height: 100px; /* 최소 높이 지정 */
        }

        .edit-mode .editable-content {
            border: 1px solid #007BFF;
        }

        button {
            padding: 10px;
            background-color: #28A745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        button[disabled] {
            background-color: #868e96;
            cursor: not-allowed;
        }

        #back-button {
            display: inline-block;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        #back-button:hover {
            background-color: #0056b3;
        }
    </style>
    <title><?php echo $post_data['post_name']; ?>의 정보</title>
</head>
<body>
    <div id="content">
        <h1><?php echo $post_data['post_name']; ?></h1>
        <div class="editable-content" contenteditable="false"><?php echo $post_data['post_content']; ?></div>
        <br>
        <button onclick="toggleEditMode()">수정</button>
        <button onclick="updateTopic()">저장</button>
        <button onclick="deleteTopic()">삭제</button>

        <!-- 이전으로 돌아가기 버튼 -->
        <a href="list.php" id="back-button">이전으로 돌아가기</a>
    </div>

    <script>
        const topicTitle = document.getElementById('topic-title');
        const editableContent = document.querySelector('.editable-content');
        const updateButton = document.querySelector('button:nth-child(2)');

        function toggleEditMode() {
            const isEditable = editableContent.contentEditable === "true";
            editableContent.contentEditable = !isEditable;

            if (isEditable) {
                editableContent.style.border = "1px";
                updateButton.disabled = true;
            } else {
                editableContent.style.border = "1px solid #007BFF";
                updateButton.disabled = false;
            }
        }

        function updateTopic() {
            const isEditable = editableContent.contentEditable === "true";
            if (isEditable) {
                const updatedContent = editableContent.innerHTML;
                fetch('list.update_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        title: topicTitle.textContent,
                        content: updatedContent
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('성공적으로 업데이트되었습니다.');
                        location.reload();
                    } else {
                        alert('업데이트에 실패했습니다.');
                    }
                });
            }
        }

        function deleteTopic() {
            const confirmDelete = confirm("정말로 삭제하시겠습니까?");
            if (confirmDelete) {
                fetch('list.delete_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        title: topicTitle.textContent
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('성공적으로 삭제되었습니다.');
                        window.location.href = "list.php";
                    } else {
                        alert('삭제에 실패했습니다.');
                    }
                });
            }
        }
    </script>
</body>
</html>
