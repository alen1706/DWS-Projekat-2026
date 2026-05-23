<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error = "";

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

if (isset($_POST['save_changes'])) {
    $novo_ime = trim($_POST['ime']);
    $novo_prezime = trim($_POST['prezime']);
    $novi_bio = trim($_POST['bio']);
    $nova_slika_ime = $profilna; 

    if (strlen($novi_bio) > 100) {
        $error = "Biografija ne može biti duža od 100 karaktera!";
    } elseif (empty($novo_ime) || empty($novo_prezime)) {
        $error = "Ime i prezime ne mogu biti prazni!";
    } else {
        if (isset($_FILES['profilna_slika']) && $_FILES['profilna_slika']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['profilna_slika']['tmp_name'];
            $file_name = $_FILES['profilna_slika']['name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $dozvoljene_ekstenzije = array("jpg", "jpeg", "png", "gif");

            if (in_array($file_ext, $dozvoljene_ekstenzije)) {
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                $nova_slika_ime = "user_" . $user_id . "_" . time() . "." . $file_ext;
                $upload_putanja = "uploads/" . $nova_slika_ime;
                
                if (!move_uploaded_file($file_tmp, $upload_putanja)) {
                    $error = "Sistem nije uspio spasiti sliku u 'uploads' folder. Provjerite dozvole foldera.";
                    $nova_slika_ime = $profilna; 
                }
            } else {
                $error = "Pogrešan format slike! Dozvoljeni su JPG, JPEG, PNG i GIF.";
            }
        }

        if (empty($error)) {
            $stmt_update = $conn->prepare("UPDATE korisnici SET ime = ?, prezime = ?, bio = ?, profilna_slika = ? WHERE id = ?");
            $stmt_update->bind_param("ssssi", $novo_ime, $novo_prezime, $novi_bio, $nova_slika_ime, $user_id);
            
            if ($stmt_update->execute()) {
                header("Location: profil.php");
                exit();
            } else {
                $error = "Greška izvršavanja u bazi podataka: " . $stmt_update->error;
            }
            $stmt_update->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi Profil - Filmoteka</title>
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
    <div class="profile-card edit-card">
        <form action="edit_profil.php" method="POST" enctype="multipart/form-data" class="edit-profile-form">
            
            <div class="image-upload-wrapper" onclick="document.getElementById('file-input').click();">
                <img src="<?php echo $slika_putanja; ?>" alt="Profilna slika" class="profile-img-large" id="profile-preview">
                <div class="image-overlay-hover">
                    <span class="pencil-icon">✏️</span>
                </div>
            </div>
            
            <input type="file" id="file-input" name="profilna_slika" accept="image/*" style="display: none;">

            <?php if(!empty($error)): ?>
                <div class="alert alert-danger" style="margin-bottom: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-group-modern">
                <label class="form-label-modern">Ime</label>
                <input type="text" name="ime" value="<?php echo htmlspecialchars($ime); ?>" class="form-input-modern" required>
            </div>

            <div class="form-group-modern">
                <label class="form-label-modern">Prezime</label>
                <input type="text" name="prezime" value="<?php echo htmlspecialchars($prezime); ?>" class="form-input-modern" required>
            </div>

            <div class="form-group-modern">
                <label class="form-label-modern">Kratki bio (do 100 karaktera)</label>
                <textarea name="bio" maxlength="100" class="form-textarea-modern" placeholder="Napišite nešto o sebi..."><?php echo htmlspecialchars($bio); ?></textarea>
            </div>

            <div class="profile-buttons-modern">
                <button type="submit" name="save_changes" class="btn btn-save-modern">Save changes</button>
                <a href="profil.php" class="btn btn-discard-modern">Discard changes</a>
            </div>
        </form>
    </div>
</div>

<footer>
    © 2026 Filmoteka. All rights reserved.
</footer>

<script>
document.getElementById('file-input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>