<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $datum_rodenja = $_POST['datum_rodenja'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($ime) || empty($prezime) || empty($datum_rodenja) || empty($username) || empty($password)) {
        $error = "Sva polja su obavezna!";
    } elseif ($username === 'admin') {
        $error = "Korisničko ime 'admin' je rezervisano!";
    } else {
        $stmt = $conn->prepare("SELECT id FROM korisnici WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Korisničko ime je zauzeto!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt_insert = $conn->prepare("INSERT INTO korisnici (ime, prezime, datum_rodenja, username, password, role) VALUES (?, ?, ?, ?, ?, 'guest')");
            $stmt_insert->bind_param("sssss", $ime, $prezime, $datum_rodenja, $username, $hashed_password);
            
            if ($stmt_insert->execute()) {
                $success = "Nalog uspješno kreiran! <a href='login.php' style='color:#fff; text-decoration:underline;'>Prijavite se ovdje</a>";
            } else {
                $error = "Greška pri kreiranju naloga.";
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmoteka - Registracija</title>
    <link rel="stylesheet" href="stil.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-body">

<div class="login-container">
    <div class="login-logo">REGISTRACIJA</div>
    
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if(!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="registracija.php" method="POST" class="login-form">
        <div class="input-group">
            <input type="text" name="ime" placeholder="Ime" required>
        </div>
        <div class="input-group">
            <input type="text" name="prezime" placeholder="Prezime" required>
        </div>
        <div class="input-group">
            <label style="display:block; color:#aaa; margin-bottom:5px; font-size:14px; text-align:left;">Datum rođenja:</label>
            <input type="date" name="datum_rodenja" required>
        </div>
        <div class="input-group">
            <input type="text" name="username" placeholder="Željeno korisničko ime" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Lozinka" required>
        </div>
        <button type="submit" name="register" class="btn btn-login">Kreiraj Profil</button>
        <a href="login.php" class="btn btn-register-link" style="text-align:center;">Nazad na prijavu</a>
    </form>
</div>

</body>
</html>