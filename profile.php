<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
    $stmt->execute([$fullname, $email, $user_id]);

    echo "Dane zostały zaktualizowane!";
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Mój Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="index.php">Strona Główna</a></li>
            <li><a href="profile.php">Mój Profil</a></li>
            <li><a href="logout.php">Wyloguj</a></li>
        </ul>
    </div>

    <div class="page-content">
        <h1>Edytuj swój profil</h1>
        <form method="POST" action="profile.php">
            <label>Fullname: <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required></label><br>
            <label>Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required></label><br>
            <input type="submit" value="Zapisz zmiany">
        </form>
    </div>
</body>
</html>
