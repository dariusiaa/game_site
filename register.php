<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        echo "Użytkownik już istnieje!";
    } else {
        $sql = "INSERT INTO users (username, password, email, fullname) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password, $email, $fullname]);
        echo "Rejestracja zakończona sukcesem!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="page-content">
        <h1>Rejestracja</h1>
        <form method="POST" action="register.php">
            <label>Username: <input type="text" name="username" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Fullname: <input type="text" name="fullname" required></label><br>
            <input type="submit" value="Zarejestruj">
        </form>
    </div>
</body>
</html>
