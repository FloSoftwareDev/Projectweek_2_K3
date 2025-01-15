<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header('Location: index.php');
    exit();
}

$questions = [
    ['text' => 'What is 2 + 2?', 'A' => '3', 'B' => '4', 'C' => '5', 'correct' => 'B'],
    ['text' => 'What is the capital of France?', 'A' => 'London', 'B' => 'Paris', 'C' => 'Berlin', 'correct' => 'B'],
    ['text' => 'What is 10 / 2?', 'A' => '5', 'B' => '6', 'C' => '7', 'correct' => 'A'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $index => $question) {
        if ($_POST["answer$index"] === $question['correct']) {
            $score++;
        }
    }
    $_SESSION['score'] = $score;
    header('Location: quiz_result.php');
    exit();
}
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
        <?php foreach ($questions as $index => $question): ?>
            <div>
                <h2>Question <?= $index + 1 ?>: <?= $question['text'] ?></h2>
                <label>
                    <input type="radio" name="answer<?= $index ?>" value="A" required> A. <?= $question['A'] ?>
                </label><br>
                <label>
                    <input type="radio" name="answer<?= $index ?>" value="B"> B. <?= $question['B'] ?>
                </label><br>
                <label>
                    <input type="radio" name="answer<?= $index ?>" value="C"> C. <?= $question['C'] ?>
                </label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
