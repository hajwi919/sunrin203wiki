<!DOCTYPE html>
<html>
    <head>
        <title>20301 위키</title>
        <style>
            .register-container {
                width: 300px;
                margin: 100px auto 0;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h1 {
                color: #343a40;
                text-align: center;
            }
            p {
                margin-bottom: 10px;
            }
            input[type="text"], input[type="password"] {
                width: 92.5%;
                padding: 10px;
                border: 1px solid #ced4da;
                border-radius: 4px;
            }
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                border: none;
                background-color: #ff7824;
                color: white;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <?php require_once("inc/header.php"); ?>
        <div class="register-container">
            <h1>20301 위키<br/>회원가입</h1>
            <form method="POST" action="register.post.php">
            <p>
                아이디 : 
                <input type="text" name="login_id" />
            <p>
            <p>
                비밀번호 : 
                <input type="password" name="login_pw" />
            <p>            
            <p>
                이름 : 
                <input type="text" name="login_name" />
            <p>
            <p><input type="submit" value="회원가입"></p>
            </form>
        </div>
    </body>
</html>
