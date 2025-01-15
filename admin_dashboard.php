<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="container">
    <h1>Admin Dashboard</h1>
    <ul>
        <li><a href="view_leaderboard.php">View Leaderboard</a></li>
        <li><a href="create_questions.php">Create Questions</a></li>
        <li><a href="edit_questions.php">Edit/Delete Questions</a></li>
        <li><a href="view_student_scores.php">View Student Scores</a></li>
    </ul>
    <a href="index.php">Log Out</a>
</div>
</body>
</html>
