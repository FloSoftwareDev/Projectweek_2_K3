<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentName = $_POST['studentName'];
    if (!empty($studentName)) {
        $questions = [
            ["text" => "What is 2 + 2?", "A" => "3", "B" => "4", "C" => "5", "correct" => "B"],
            ["text" => "What is the capital of France?", "A" => "Berlin", "B" => "Madrid", "C" => "Paris", "correct" => "C"]
        ];

        $score = 0;

        foreach ($questions as $index => $question) {
            echo "<h3>Question " . ($index + 1) . ": " . $question['text'] . "</h3>";
            echo "A. " . $question['A'] . "<br>";
            echo "B. " . $question['B'] . "<br>";
            echo "C. " . $question['C'] . "<br>";

            echo "<form method='post' action='score.php'>
                    <input type='hidden' name='studentName' value='" . htmlspecialchars($studentName) . "'>
                    <input type='hidden' name='questionIndex' value='" . $index . "'>
                    <input type='radio' name='answer' value='A' required> A<br>
                    <input type='radio' name='answer' value='B'> B<br>
                    <input type='radio' name='answer' value='C'> C<br>
                    <button type='submit'>Submit Answer</button>
                </form>";
        }
    } else {
        echo "Invalid Username. <a href='student_login.php'>Try Again</a>";
    }
}

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=quizit", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
