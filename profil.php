<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT ime, prezime, bio, profilna_slika FROM korisnici WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$ime = $user ? $user['ime'] : 'Admin';
$prezime = $user ? $user['prezime'] : 'Administrator';
$bio = $user ? $user['bio'] : '';
$profilna = ($user && !empty($user['profilna_slika'])) ? $user['profilna_slika'] : 'guest.png';

$slika_putanja = "uploads/" . $profilna;
if (!file_exists($slika_putanja) || $profilna == 'guest.png') {
    $slika_putanja = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png";
}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Filmoteka</title>
    <link rel="stylesheet" href="stil.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">FILMOTEKA</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="logout.php" class="logout-link">Logout</a>
    </nav>
</header>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-avatar-container">
            <img src="<?php echo $slika_putanja; ?>" alt="Profilna slika" class="profile-img-large">
        </div>
        <div class="profile-info-box">
            <h2 class="profile-name"><?php echo htmlspecialchars($ime . ' ' . $prezime); ?></h2>
            <p class="profile-bio"><?php echo htmlspecialchars($bio); ?></p>
        </div>
        <a href="edit_profil.php" class="btn btn-play edit-profile-btn">Edit profile</a>
    </div>
</div>

<footer>
    © 2026 Filmoteka. All rights reserved.
</footer>

</body>
</html>