<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header('Location: index.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "Quizit";

$conn = new mysqli($servername, $username, $password, $database); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions from the database
$questions = [];
$sql = "SELECT id, text, answerA, answerB, answerC, correct FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

// Handle quiz submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;

    foreach ($questions as $index => $question) {
        $questionId = $question['id'];
        $userAnswer = $_POST["answer$questionId"];

        // Validate the answer against the database
        $sql = "SELECT correct FROM questions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $stmt->bind_result($correctAnswer);
        $stmt->fetch();
        $stmt->close();

        if ($userAnswer === $correctAnswer) {
            $score++;
        }
    }

    // Save the score to the database
    $studentName = $_SESSION['studentName'];
    $stmt = $conn->prepare("INSERT INTO scores (student_name, score) VALUES (?, ?)");
    $stmt->bind_param("si", $studentName, $score);
    $stmt->execute();
    $stmt->close();

    $_SESSION['score'] = $score;
    header('Location: quiz_result.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Quiz</title>
</head>
<body>
<div class="container">
    <h1>Welcome, <?= $_SESSION['studentName'] ?>!</h1>
    <form method="POST">
        <?php foreach ($questions as $question): ?>
            <div>
                <h2>Question <?= $question['id'] ?>: <?= $question['text'] ?></h2>
                <label>
                    <input type="radio" name="answer<?= $question['id'] ?>" value="A" required> A. <?= $question['answerA'] ?>
                </label><br>
                <label>
                    <input type="radio" name="answer<?= $question['id'] ?>" value="B"> B. <?= $question['answerB'] ?>
                </label><br>
                <label>
                    <input type="radio" name="answer<?= $question['id'] ?>" value="C"> C. <?= $question['answerC'] ?>
                </label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
