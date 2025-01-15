<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];
    if ($role == 'admin') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username == 'admin' && $password == 'password123') {
            $_SESSION['role'] = 'admin';
            header('Location: admin_dashboard.php');
            exit();
        } else {
            $error = "Invalid Admin Credentials.";
        }
    } elseif ($role == 'student') {
        $studentName = $_POST['studentName'];
        if (!empty($studentName)) {
            $_SESSION['role'] = 'student';
            $_SESSION['studentName'] = $studentName;
            header('Location: student_quiz.php');
            exit();
        } else {
            $error = "Please enter your name.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>
<div class="container">
    <h1>Login Page</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="role">Select your role:</label>
        <select id="role" name="role" required>
            <option value="">--Select Role--</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select>
        <div id="admin-fields" style="display: none;">
            <label for="username">Admin Username:</label>
            <input type="text" id="username" name="username">
            <label for="password">Admin Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div id="student-fields" style="display: none;">
            <label for="studentName">Student Name:</label>
            <input type="text" id="studentName" name="studentName">
        </div>
        <button type="submit">Login</button>
    </form>
</div>
<script>
    const roleSelect = document.getElementById('role');
    const adminFields = document.getElementById('admin-fields');
    const studentFields = document.getElementById('student-fields');

    roleSelect.addEventListener('change', () => {
        adminFields.style.display = roleSelect.value === 'admin' ? 'block' : 'none';
        studentFields.style.display = roleSelect.value === 'student' ? 'block' : 'none';
    });
</script>
</body>
</html>
