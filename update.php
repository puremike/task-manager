<?php
include './database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];

    if (empty($title)) {
        header("Location: edit.php?id=$id&error=Title is required");
        exit();
    }

    try {
        $stmt = $conn->prepare("UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        header("Location: index.php");
    } catch (PDOException $e) {
        header("Location: edit.php?id=$id&error=Error updating task");
    }
}
?>
