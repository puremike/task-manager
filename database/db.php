<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_manager";

try {
    // Create a new PDO instance and connect to the MySQL server
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the database exists, if not, create it
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    // Connect to the database
    $conn->exec("USE $dbname");

    // Check if the 'tasks' table exists, if not, create it
    $result = $conn->query("SHOW TABLES LIKE 'tasks'");
    if ($result->rowCount() == 0) {
        $sql = "CREATE TABLE tasks (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            status ENUM('pending', 'completed') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn->exec($sql);
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
