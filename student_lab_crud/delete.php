<?php
require_once 'db_connect.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn = getConnection();
    
    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        header("Location: select.php?success=3");
    } else {
        header("Location: select.php?error=1");
    }
    
    $stmt->close();
} else {
    header("Location: select.php");
}
exit();