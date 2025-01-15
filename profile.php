<?php
session_start();
include 'database.php'; // Ensure this file connects to your database

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Fetch user details from the database
$query = "SELECT * FROM user WHERE email = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User details not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile | Online Quiz System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">User Profile</h1>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <th>College</th>
                <td><?php echo htmlspecialchars($user['college']); ?></td>
            </tr>
            <tr>
                <th>Registration Date</th>
                <td><?php echo htmlspecialchars($user['reg_date']); ?></td>
            </tr>
        </table>
        <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</body>
</html>
