<div style='background-color: #f8f9fa; padding: 10px;'>
    <p style='text-align:right; margin: 0;'>
        <?php
        if (isset($_SESSION) === false) {
            session_start();
        }

        if (isset($_SESSION['member_id']) === false) {
            ?>
            <a href="/register.php" style='color: #4CAF50; text-decoration: none; margin-right: 20px;'>회원가입</a>
            <a href="/login.php" style='color: #4CAF50; text-decoration: none;'>로그인</a>
            <?php
        } else {
            ?>
            <a href="/logout.php" style='color: #F44336; text-decoration: none;'>로그아웃</a>
            <?php
        }
        ?>
    </p>
</div>
