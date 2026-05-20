<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user_id'] = 0;
        $_SESSION['username'] = 'admin';
        $_SESSION['role'] = 'admin';
        header("Location: index.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM korisnici WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Pogrešna lozinka!";
        }
    } else {
        $error = "Korisnik ne postoji!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmoteka - Prijava</title>
    <link rel="stylesheet" href="stil.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-body">

<div class="login-container">
    <div class="login-logo">FILMOTEKA</div>
    
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="login-form">
        <div class="input-group">
            <input type="text" name="username" placeholder="Korisničko ime" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Lozinka" required>
        </div>
        <button type="submit" name="login" class="btn btn-login">Prijavi se</button>
        <a href="registracija.php" class="btn btn-register-link">Kreirajte novi profil</a>
    </form>
</div>

</body>
</html>