<?php
include './database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title)) {
        header("Location: create.php?error=Title is required");
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        header("Location: index.php");
    } catch (PDOException $e) {
        header("Location: create.php?error=Error saving task");
    }
}
?>