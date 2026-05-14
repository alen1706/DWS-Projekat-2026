const API_KEY = '699f9163ccd54a05668f50f19ac0b0a8';
const ACCESS_TOKEN = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2OTlmOTE2M2NjZDU0YTA1NjY4ZjUwZjE5YWMwYjBhOCIsIm5iZiI6MTc3NzY2NzY1NC43NTUsInN1YiI6IjY5ZjUwZTQ2ODg1MzY3ODg1YzFhYjQxNiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.xLRWJXH3J129cd_Z5DvIwBuTA0gjyXLqAAkyK9Kxf70';
const BASE_URL = 'https://api.themoviedb.org/3';
const IMAGE_URL = 'https://image.tmdb.org/t/p/original';
const POSTER_URL = 'https://image.tmdb.org/t/p/w500';

const options = {
    method: 'GET',
    headers: {
        accept: 'application/json',
        Authorization: `Bearer ${ACCESS_TOKEN}`
    }
};

async function fetchMovies(endpoint, containerId) {
    try {
        const res = await fetch(`${BASE_URL}${endpoint}`, options);
        const data = await res.json();
        const container = document.getElementById(containerId);
        container.innerHTML = '';

        if (!data.results || data.results.length === 0) {
            container.innerHTML = '<p style="color:#888;">Nema podataka.</p>';
            return;
        }

        data.results.forEach((item, index) => {
            const title = item.title || item.name;
            const imgPath = item.poster_path
                ? `${POSTER_URL}${item.poster_path}`
                : '[via.placeholder.com](https://via.placeholder.com/500x750?text=No+Image)';
            const rating = item.vote_average ? item.vote_average.toFixed(1) : 'N/A';

            const card = document.createElement('div');
            card.className = 'movie-card';
            card.style.opacity = 0;
            card.style.transition = 'opacity 0.6s ease';
            card.innerHTML = `
                <img src="${imgPath}" alt="${title}">
                <div class="movie-overlay">
                    <h3>${title}</h3>
                    <span>⭐ ${rating}</span>
                </div>
            `;

            container.appendChild(card);
            setTimeout(() => (card.style.opacity = 1), 100 * index);
        });

        if (containerId === 'popular-movies') {
            setupHero(data.results[0]);
        }
    } catch (err) {
        console.error('Greška pri dohvaćanju filmova:', err);
    }
}

function setupHero(movie) {
    const hero = document.getElementById('hero');
    const title = document.getElementById('hero-title');
    const desc = document.getElementById('hero-description');

    hero.style.backgroundImage = `url(${IMAGE_URL}${movie.backdrop_path})`;
    title.textContent = movie.title || movie.name;
    desc.textContent = movie.overview || 'Opis nije dostupan.';
}

// Inicijalni pozivi
fetchMovies('/movie/popular?language=en-US&page=1', 'popular-movies');
fetchMovies('/tv/popular?language=en-US&page=1', 'tv-series');
fetchMovies('/movie/top_rated?language=en-US&page=1', 'top-rated');
