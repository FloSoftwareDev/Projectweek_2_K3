<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $role = $_POST['role'];

    if ($role == 1) {
        header('Location: admin_login.php');
    } elseif ($role == 2) {
        header('Location: student_login.php');
    } else {
        echo "Invalid Role Selection. Please try again.";
    }
    exit();
}
?>
