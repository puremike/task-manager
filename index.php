<?php
include "./database/db.php";

try {
    $stmt = $conn->prepare("SELECT * FROM tasks ORDER BY created_at DESC");
    $stmt->execute();
    $tasks = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching tasks: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php"><h1>Task Manager Application</h1></a>
            <nav>
                <ul>
                    <li><a href="create.php">CREATE NEW TASK</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h2>My Tasks</h2>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                    <p><?php echo htmlspecialchars($task['description']); ?></p>
                    <p>Status: <?php echo htmlspecialchars($task['status']); ?></p>
                    <a href="edit.php?id=<?php echo $task['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
