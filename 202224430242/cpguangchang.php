<?php
require_once 'dbconnect.php';
$error = '';
$success = '';

$pdo = require 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    try {
        $sno = $_POST['sno'];
        $cpname = $_POST['cpname'];
        $end = $_POST['end'];
        $story = $_POST['story'];
  
        if (empty($sno) || empty($cpname) || empty($end) || empty($story)) {
            $error = '请填写所有字段';
        } else {
    
            $stmt = $pdo->prepare("INSERT INTO juchang (sno, cpname, end, story) VALUES (:sno, :cpname, :end, :story)");
            $stmt->bindParam(':sno', $sno, PDO::PARAM_INT);
            $stmt->bindParam(':cpname', $cpname, PDO::PARAM_STR);
            $stmt->bindParam(':end', $end, PDO::PARAM_STR);
            $stmt->bindParam(':story', $story, PDO::PARAM_STR);
            
            if (!$stmt->execute()) {
                throw new Exception('添加失败: ' . print_r($stmt->errorInfo(), true));
            }
            $success = '剧目信息添加成功';
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $id = intval($_GET['id']);
    
        if ($id <= 0) {
            throw new Exception('无效的记录ID');
        }

        $pdo->beginTransaction();

        $checkStmt = $pdo->prepare("SELECT id FROM juchang WHERE id = :id");
        $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkStmt->execute();
        
        if (!$checkStmt->fetch()) {
            throw new Exception('记录不存在，删除失败');
        }
        

        $stmt = $pdo->prepare("DELETE FROM juchang WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if (!$stmt->execute()) {
            throw new Exception('删除操作失败: ' . print_r($stmt->errorInfo(), true));
        }
        

        $pdo->commit();
        $success = '剧目信息删除成功';
        header("Location: cpguangchang.php?success=delete");
        exit;
        
    } catch (Exception $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $error = $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    try {
        $id = intval($_POST['id']);
        $sno = $_POST['sno'];
        $cpname = $_POST['cpname'];
        $end = $_POST['end'];
        $story = $_POST['story'];

        if ($id <= 0 || empty($sno) || empty($cpname) || empty($end) || empty($story)) {
            $error = '请填写所有字段并选择有效记录';
        } else {

            $pdo->beginTransaction();

            $checkStmt = $pdo->prepare("SELECT id FROM juchang WHERE id = :id");
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            
            if (!$checkStmt->fetch()) {
                throw new Exception('记录不存在，更新失败');
            }
 
            $stmt = $pdo->prepare("UPDATE juchang SET sno = :sno, cpname = :cpname, end = :end, story = :story WHERE id = :id");
            $stmt->bindParam(':sno', $sno, PDO::PARAM_INT);
            $stmt->bindParam(':cpname', $cpname, PDO::PARAM_STR);
            $stmt->bindParam(':end', $end, PDO::PARAM_STR);
            $stmt->bindParam(':story', $story, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                throw new Exception('更新操作失败: ' . print_r($stmt->errorInfo(), true));
            }
            
            $pdo->commit();
            $success = '剧目信息更新成功';
            header("Location: cpguangchang.php?success=update");
            exit;
        }
    } catch (Exception $e) {
  
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $error = $e->getMessage();
    }
}

$search = '';
$filter = '';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

$whereConditions = [];
$params = [];

if (!empty($search)) {
    $whereConditions[] = "cpname LIKE :search";
    $params[':search'] = "%$search%";
}

if (!empty($filter) && $filter !== '') {
    $whereConditions[] = "end = :filter";
    $params[':filter'] = $filter;
}

$sql = "SELECT * FROM juchang";
if (!empty($whereConditions)) {
    $sql .= " WHERE " . implode(" AND ", $whereConditions);
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = '查询失败: ' . $e->getMessage() . "<br>SQL: " . $sql;
    $result = [];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>饭后小剧场 - 剧目信息管理</title>
<style>
    body {
        padding: 0;
        margin: 0;
        background-image: url('pictrue/zuihou.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .header {
        text-align: center;
        color: #accaeb;
        margin-bottom: 30px;
    }
    .form-section {
        color: #accaeb;
        padding: 20px;
        background-color: rgba(44, 62, 80, 0.5);
        border-radius: 10px;
        margin-bottom: 30px;
    }
    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    .back-button:hover {
        background: #FEC601;
    }
    form {
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        color: #a89181;
        margin-top: 20px;
    }
    th, td {
        border: 3px solid #d9d9d9;
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #d9d0d9;
        color: #333;
    }
    .search-filter {
        text-align: center;
        margin: 20px 0;
        background-color: rgba(44, 62, 80, 0.5);
        padding: 15px;
        border-radius: 10px;
    }
    .form-group {
        display: inline-block;
        margin: 0 15px;
        font-size: 18px;
    }
    .btn {
        padding: 8px 15px;
        background: #2c3e50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .btn:hover {
        background: #FEC601;
    }
    .no-data {
        color: red;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }
    .message {
        margin: 15px 0;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        animation: fadeIn 0.5s;
    }
    .message-success {
        background-color: rgba(0, 128, 0, 0.3);
        color: #006400;
        border: 1px solid #008000;
    }
    .message-error {
        background-color: rgba(255, 0, 0, 0.3);
        color: #8B0000;
        border: 1px solid #ff0000;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>饭后小剧场 - 剧目信息管理</h1>
    </div>

    <?php if (!empty($success)): ?>
        <div class="message message-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="message message-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="search-filter">
        <form method="get" action="">
            <div class="form-group">
                <label for="search">搜索:</label>
                <input type="text" id="search" name="search" placeholder="输入组合名" value="<?php echo htmlspecialchars($search);?>">
            </div>
            <div class="form-group">
                <label for="filter">筛选:</label>
                <select id="filter" name="filter">
                    <option value="">全部</option>
                    <option value="he" <?php echo $filter == 'he' ? 'selected' : ''; ?>>he</option>
                    <option value="be" <?php echo $filter == 'be' ? 'selected' : ''; ?>>be</option>
                    <option value="oe" <?php echo $filter == 'oe' ? 'selected' : ''; ?>>oe</option>
                </select>
            </div>
            <button type="submit" class="btn">搜索/筛选</button>
            <a href="cpguangchang.php" class="btn">重置</a>
        </form>
    </div>
    
    <a href="zang1.php" class="back-button">返回首页</a>

    <div class="form-section">
        <h2>添加剧目信息</h2>
        <form method="post">
            <input type="number" name="sno" placeholder="序号" required style="padding: 8px; margin-right: 10px; width: 100px;">
            <input type="text" name="cpname" placeholder="组合名" required style="padding: 8px; margin-right: 10px; width: 150px;">
            <input type="text" name="end" placeholder="结局" required style="padding: 8px; margin-right: 10px; width: 100px;">
            <input type="text" name="story" placeholder="故事" required style="padding: 8px; width: 300px;">
            <button type="submit" name="add" class="btn">添加</button>
        </form>
    </div>

    <?php 
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
        $edit_id = intval($_GET['id']);
        try {
            $stmt = $pdo->prepare("SELECT * FROM juchang WHERE id = :id");
            $stmt->bindParam(':id', $edit_id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!$row) {
                throw new Exception('要编辑的记录不存在');
            }
        } catch (PDOException $e) {
            $error = '查询编辑数据失败: ' . $e->getMessage();
            $row = false;
        } catch (Exception $e) {
            $error = $e->getMessage();
            $row = false;
        }
        
        if ($row) {
    ?>
    <div class="form-section">
        <h2>编辑剧目信息</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="number" name="sno" value="<?php echo $row['sno']; ?>" style="padding: 8px; margin-right: 10px; width: 100px;">
            <input type="text" name="cpname" value="<?php echo $row['cpname']; ?>" style="padding: 8px; margin-right: 10px; width: 150px;">
            <input type="text" name="end" value="<?php echo $row['end']; ?>" style="padding: 8px; margin-right: 10px; width: 100px;">
            <input type="text" name="story" value="<?php echo $row['story']; ?>" style="padding: 8px; width: 300px;">
            <button type="submit" name="update" class="btn">更新</button>
        </form>
    </div>
    <?php } else { ?>
        <div class="message message-error"><?php echo !empty($error) ? $error : '未找到要编辑的剧目信息'; ?></div>
    <?php } } ?>
    

    <div class="form-section">
        <h2>剧场信息列表</h2>
        <table border="1">
            <tr>
                <th>序号</th>
                <th>组合名</th>
                <th>结局</th>
                <th>故事</th>
                <th>操作</th>
            </tr>
            <?php if (!empty($error) && strpos($error, '查询失败') !== false): ?>
                <tr>
                    <td colspan="5" class="message-error"><?php echo $error; ?></td>
                </tr>
            <?php elseif (!empty($result)): ?>
                <?php foreach ($result as $row): ?> 
                <tr>
                    <td><?php echo $row['sno'];?></td>
                    <td><?php echo $row['cpname'];?></td>
                    <td><?php echo $row['end'];?></td>
                    <td><?php echo $row['story'];?></td>
                    <td>
                        <a href="cpguangchang.php?action=edit&id=<?php echo $row['id']; ?>" class="btn" style="background-color: #3498db; margin-right: 5px;">编辑</a>
                        <a href="cpguangchang.php?action=delete&id=<?php echo $row['id']; ?>" class="btn" style="background-color: #e74c3c;" onclick="return confirm('确定要删除这条记录吗？')">删除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?> 
                <tr>
                    <td colspan="5" class="no-data">暂无剧目信息</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php 

?>
</body>
</html>