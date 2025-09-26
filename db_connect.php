<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'student_crud');

// Create connection
function getConnection() {
    static $conn;
    
    if ($conn === null) {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Set charset to utf8mb4
        mysqli_set_charset($conn, "utf8mb4");
    }
    
    return $conn;
}

// Function to close database connection
function closeConnection() {
    global $conn;
    if ($conn) {
        mysqli_close($conn);
    }
}
?>