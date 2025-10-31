<?php

require_once 'dbconnect.php';
session_start(); 


$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['userpwd'])) {
        $username = trim($_POST['username']);
        $password = $_POST['userpwd'];
        
     
        if (empty($username)) {
            $error = '请输入用户名';
        } elseif (empty($password)) {
            $error = '请输入密码';
        } else {
            try {
               
                $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
                $stmt->execute([':username' => $username]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($password, $user['password'])) {
                    
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: zang1.php");
                    exit;
                } else {
                    $error = '用户名或密码错误';
                }
            } catch (PDOException $e) {
                $error = '数据库错误: ' . $e->getMessage();
            }
        }
    } else {
        $error = '请输入用户名和密码';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            background-image: url('pictrue/cover.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        #logindiv {
            padding-top: 0;
            margin-left: 0;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            padding: 0 20px;
        }
        
        #username, #userpwd {
            border: 3px solid #B71C1C;
            height: 40px;
            border-radius: 20px;
            padding: 0 15px;
            width: 100%;
            margin: 10px auto;
            display: block;
            box-sizing: border-box;
        }
        
        #login {
            border: 0;
            margin-top: 20px;
            border-radius: 20px;
            width: 100%;
            height: 45px;
            background: #B71C1C;
            color: white;
            font-size: 16px;
            margin: 20px auto 10px;
            display: block;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        #login:hover {
            background-color: #8B0000;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
            color: #333;
        }
        
        form {
            background: rgba(255, 255, 255, 0.9);
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .message-error {
            background-color: rgba(255, 0, 0, 0.1);
            border-left: 4px solid #ff0000;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 0 5px 5px 0;
        }
    </style>
</head>
<body>
    <div id="logindiv">
        
        <?php if (!empty($error)): ?>
            <div class="message-error">
                <strong style="color: #ff0000; font-weight: bold;">错误：</strong>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="login.php"> 
            <label for="username">用户名:</label>
            <input type="text" name="username" id="username" 
                value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required />
            
            <br />
            <label for="userpwd">密&nbsp&nbsp&nbsp码:</label>
            <input type="password" name="userpwd" id="userpwd" required />
            <br />
            <input type="submit" name="login" id="login" value="登录" />
            <br />
            <a href="register.php" style="display: block; text-align: center; margin-top: 15px; color: #333; text-decoration: none;">
                没有账号？立即注册
            </a>
        </form> 
    </div>
</body>
</html>