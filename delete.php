<?php
include './database/db.php';

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: index.php");
} catch (PDOException $e) {
    die("Error deleting task: " . $e->getMessage());
}
?>