<?php
require_once 'dbconnect.php';
$error = '';
$success = '';
try {
    $conn = require 'dbconnect.php';
    if (!$conn instanceof PDO) {
        throw new Exception('数据库连接对象无效');
    }
} catch (Exception $e) {
    $error = '数据库连接失败: ' . $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error)) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['userpwd']) ? trim($_POST['userpwd']) : '';
    $password2 = isset($_POST['confirmpwd']) ? trim($_POST['confirmpwd']) : '';
    
    try {
        if (empty($username) || empty($password) || empty($password2)) {
            $error = '请填写所有字段';
        } elseif (strlen($password) < 6) {
            $error = '密码至少需要6个字符';
        } elseif ($password !== $password2) {
            $error = '两次输入的密码不一致';
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                $error = '用户名已存在，请选择其他用户名';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->execute([
                    ':username' => $username,
                    ':password' => $hashedPassword
                ]);
                header("Location: login.php?register=success");
                exit;
            }
        }
    } catch (PDOException $e) {
        $error = '注册失败: ' . $e->getMessage();
        error_log("Registration Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户注册</title>
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
            font-family: Arial, sans-serif;
        }
        
        #logindiv {
            padding-top: 0;
            margin-left: 0;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            padding: 0 20px;
        }
        
        #username, #userpwd, #confirmpwd {
            border: 3px solid #B71C1C;
            height: 40px;
            border-radius: 20px;
            padding: 0 15px;
            width: 100%;
            margin: 10px auto;
            display: block;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        #register {
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
            font-weight: bold;
        }
        
        #register:hover {
            background-color: #8B0000;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
            color: #333;
            font-size: 16px;
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
            color: #8B0000;
            font-weight: bold;
        }
        
        .message-success {
            background-color: rgba(0, 128, 0, 0.1);
            border-left: 4px solid #008000;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 0 5px 5px 0;
            color: #006400;
            font-weight: bold;
        }
        
        .password-hint {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div id="logindiv">
        <?php if (!empty($error)): ?>
            <div class="message-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="post" action="register.php">
            <label for="username">用户名:</label>
            <input type="text" name="username" id="username" required placeholder="请输入用户名" />
            
            <label for="userpwd">密码:</label>
            <input type="password" name="userpwd" id="userpwd" required placeholder="请输入密码" />
            <div class="password-hint">密码至少6位，建议包含字母和数字</div>
            
            <label for="confirmpwd">确认密码:</label>
            <input type="password" name="confirmpwd" id="confirmpwd" required placeholder="请再次输入密码" />
            
            <input type="submit" name="register" id="register" value="注册" />
            <a href="login.php" style="text-align: center; display: block; margin-top: 15px; color: #333; text-decoration: none;">已有账号？立即登录</a>
        </form> 
    </div>
</body>
</html>