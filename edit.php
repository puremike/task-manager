<?php
include './database/db.php';

$id = $_GET['id'];
try {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $task = $stmt->fetch();
    if (!$task) {
        throw new Exception("Task not found");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        a {
            text-decoration: none;
        }

        a:hover {
            color:#8ac0f2;
        }

        button {
            margin-bottom: 40px;
        }

</style>
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php"><h1>Task Manager Application</h1></a>
            <nav>
                <ul>
                    <li><a href="index.php">TASKS</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h2>Edit Task</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            <label for="description">Description:</label>
            <textarea name="description" id="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="pending" <?php if ($task['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                <option value="completed" <?php if ($task['status'] == 'completed') echo 'selected'; ?>>Completed</option>
            </select>
            <button type="submit">Update Task</button>
        </form>
        <a href="index.php">← Back to Tasks</a>
    </div>
</body>
</html>
