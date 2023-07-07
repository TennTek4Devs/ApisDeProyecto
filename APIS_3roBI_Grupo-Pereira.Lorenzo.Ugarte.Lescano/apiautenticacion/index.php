<?php

session_start();

require 'bd.php';

$user = null;

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (!empty($results)) {
    $user = $results;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bolt</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require 'header.php'; ?>

    <?php if($user): ?>
    <br> Bienvenido <?= $user['email']; ?>
    <br>Esta logeado correctamente
    <a href="exit.php">Logout</a>
    <?php else: ?>
    <h1>Login or Sign Up</h1>

    <a href="login.php">Login</a> or
    <a href="signup.php">Sign Up</a>
    <?php endif; ?>
</body>

</html>