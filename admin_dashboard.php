<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'password123') {
        echo "<h1>Welcome, Admin!</h1>";
        echo "<h2>Admin Dashboard</h2>";
        echo "<ul>
                <li><a href='view_leaderboard.php'>View Leaderboard</a></li>
                <li><a href='create_questions.php'>Create Questions</a></li>
                <li><a href='manage_questions.php'>Edit/Delete Questions</a></li>
                <li><a href='view_scores.php'>View Student Scores</a></li>
                <li><a href='index.html'>Log Out</a></li>
            </ul>";
    } else {
        echo "Invalid Admin Credentials. <a href='admin_login.php'>Try Again</a>";
    }
}
?>
