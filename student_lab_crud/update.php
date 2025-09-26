<?php
require_once 'db_connect.php';

$error = '';
$success = '';
$student = null;

// Get student data
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn = getConnection();
    
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    
    if (!$student) {
        header("Location: select.php");
        exit();
    }
    
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    
    if (empty($name) || empty($email) || empty($course)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $conn = getConnection();
        
        // Check if email exists for other students
        $stmt = $conn->prepare("SELECT id FROM students WHERE email = ? AND id != ?");
        $stmt->bind_param("si", $email, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Email already exists for another student.";
        } else {
            // Update student data
            $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $email, $course, $id);
            
            if ($stmt->execute()) {
                header("Location: select.php?success=2");
                exit();
            } else {
                $error = "Error updating record: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Student
                            <a href="select.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required 
                                       value="<?php echo htmlspecialchars($student['name']); ?>">
                                <div class="invalid-feedback">
                                    Please enter a name.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                       value="<?php echo htmlspecialchars($student['email']); ?>">
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="course" class="form-label">Course</label>
                                <input type="text" class="form-control" id="course" name="course" required
                                       value="<?php echo htmlspecialchars($student['course']); ?>">
                                <div class="invalid-feedback">
                                    Please enter a course.
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Form Validation Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>