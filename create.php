<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
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
        <h2>Create Task</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <form action="store.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
            <button type="submit">Create Task</button>
        </form>
        <a href="index.php">← Back to Tasks</a>
    </div>
</body>
</html>
