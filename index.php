<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmoteka</title>
    <link rel="stylesheet" href="stil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">FILMOTEKA</div>
    <nav>
        <a href="#">Home</a>
        <a href="#popular">Movies</a>
        <a href="#series">Series</a>
        <a href="#mylist">Top Rated</a>
        <span class="user-info">Zdravo, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)</span>
        <a href="logout.php" class="logout-link">Odjavi se</a>
    </nav>
</header>

<section class="hero" id="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-tag">TRENDING NOW</span>
        <h1 id="hero-title">Loading...</h1>
        <p id="hero-description">Loading trending movies...</p>
        <div class="hero-buttons">
            <button class="btn btn-play">▶ Watch</button>
            <button class="btn btn-info">ⓘ Info</button>
        </div>
    </div>
</section>

<main>
    <section class="section" id="popular">
        <div class="section-header">
            <h2>🔥 Popular movies</h2>
        </div>
        <div class="movie-row" id="popular-movies"></div>
    </section>

    <section class="section" id="series">
        <div class="section-header">
            <h2>📺 Popular series</h2>
        </div>
        <div class="movie-row" id="tv-series"></div>
    </section>

    <section class="section" id="mylist">
        <div class="section-header">
            <h2>⭐ Top Rated</h2>
        </div>
        <div class="movie-row" id="top-rated"></div>
    </section>
</main>

<footer>
    © 2026 Filmoteka. All rights reserved.
</footer>

<script src="script.js"></script>
</body>
</html>