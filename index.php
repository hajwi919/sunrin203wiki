<?php
// 로그인 되어 있으면 목록으로 이동
session_start();
if (isset($_SESSION['member_id'])){
    header("Location: /list.php");
    exit();
}

// 서비스 소개
?>
<!DOCTYPE html>
<html>
    <head>
        <title>203 위키</title>
        <style>
            h1 {
                color: #343a40;
                text-align: center;
                font-family: Arial, sans-serif;
            }
            img {
                margin: auto;
                display: block;
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <?php require_once("inc/header.php"); ?>
        <h1>203 위키</h1>
        <img src="https://i3.ruliweb.com/ori/21/11/06/17cf45f51df19a54f.gif" alt="main">
    </body>
</html>